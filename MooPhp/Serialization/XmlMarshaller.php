<?php
namespace MooPhp\Serialization;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class XmlMarshaller implements Marshaller {

	/**
	 * @var \MooPhp\Serialization\Config\MarshallerConfig
	 */
	private $_config;

	public function __construct(Config\MarshallerConfig $config) {
		$this->_config = $config;
	}

	protected function _simpleValueAsType($value, Config\Types\PropertyType $type) {
		if (!isset($value)) {
			return null;
		}

		switch ($type->getType()) {
			case "string":
				return (string)$value;
			case "int":
				return (int)$value;
			case "bool":
				return (bool)$value;
			case "float":
				return (float)$value;
			case "stringbool":
				return ($value && $value != "false") ? true : false;
			case "array":
			case "ref":
				throw new \RuntimeException("Complex types not supported for simple values");
			default:
				throw new \RuntimeException("Unknown type " . $type->getType());
		}
	}

	protected function _elementAsType(\XMLReader $xmlReader, Config\Types\PropertyType $type) {
		switch ($type->getType()) {
			case "ref":
				return $this->_unmarshall($xmlReader, $type->getRef());
			case "array":
				$data = array();
				while ($xmlReader->read()) {
					switch ($xmlReader->nodeType) {
						case \XMLReader::ELEMENT:
							$data[] = $this->_elementAsType($xmlReader, $type->getValue());
							break;
						case \XMLReader::END_ELEMENT:
							$xmlReader->next();
							return $data;
						case \XMLReader::WHITESPACE:
						case \XMLReader::COMMENT:
						case \XMLReader::SIGNIFICANT_WHITESPACE:
							break;
						default:
							throw new \RuntimeException("Found node of type " . $xmlReader->nodeType . " named " . $xmlReader->name . " of value " . $xmlReader->readString());
					}
				}
				throw new \RuntimeException("Array processing readed an END_ELEMENT");

			case "string":
			case "int":
			case "float":
			case "stringbool":
			case "bool":
				$data = $xmlReader->readInnerXml();
				$ret = $this->_simpleValueAsType($data, $type);
				$xmlReader->next();
				return $ret;
			default:
				throw new \RuntimeException("Unknown type " . $type->getType());
		}
	}

	public function marshall($object, $ref) {
		throw new \RuntimeException("Unsupported at this time");
		$xmlWriter = new \XMLWriter();
		$xmlWriter->openMemory();
		$xmlWriter->setIndent(true);
		$xmlWriter->setIndentString(' ');
		$xmlWriter->startDocument("1.0", "UTF-8");

		$this->_marshall($object, $ref, $xmlWriter);

		$xmlWriter->endDocument();
		return $xmlWriter->outputMemory();
	}

	public function unmarshall($data, $ref) {
		$xmlReader = new \XMLReader();
		$xmlReader->XML($data);

		$ignoreNodeTypes = array(
			\XMLReader::WHITESPACE,
			\XMLReader::SIGNIFICANT_WHITESPACE,
			\XMLReader::COMMENT
		);

		do {
			$read = $xmlReader->read();
		} while ($read && in_array($xmlReader->nodeType, $ignoreNodeTypes));

		if($xmlReader->nodeType != \XMLReader::ELEMENT) {
			$xmlReader->close();
			throw new \RuntimeException("First thing I read was not an element.");
		}
		$retval = $this->_unmarshall($xmlReader, $ref);
		$xmlReader->close();
		return $retval;
	}

	protected function _unmarshall(\XMLReader $xmlReader, $ref) {

		$currentConfig = $this->_config->getConfigElement($ref);
		if (!isset($currentConfig)) {
			throw new \RuntimeException("Cannot find config entry for $ref");
		}

		$attributes = array();
		$elements = array();

		do {
			// We need to build up the full properties list, and our actual type, from the children.
			$objectType = $currentConfig->getType();
			if (!isset($objectType)) {
				throw new \RuntimeException("Config file error for $ref");
			}

			if ($currentConfig->getProperties()) {
				foreach ($currentConfig->getProperties() as $property => $details) {
					$type = "element";
					$name = $property;
					if ($options = $details->getOption("xml")) {
						if ($altType = $options->getOption("type")) {
							$type = $altType;
						}
						if ($altName = $options->getOption("name")) {
							$name = $altName;
						}
					}
					switch ($type) {
						case "element":
							$elements[$name] = array($property, $details);
							break;
						case "attribute":
							$attributes[$name] = array($property, $details);
							break;
						default:
							throw new \RuntimeException("Invalid config for $property");
					}
				}
			}

			if ($currentConfig->getDiscriminator()) {
				$discriminatorConfig = $currentConfig->getDiscriminator();

				$type = "element";
				$name = $discriminatorConfig->getProperty();
				if ($options = $discriminatorConfig->getOption("xml")) {
					if ($altType = $options->getOption("type")) {
						$type = $altType;
					}
					if ($altName = $options->getOption("name")) {
						$name = $altName;
					}
				}
				switch ($type) {
					case "attribute":
						$subTypeName = $xmlReader->getAttribute($name);
						break;
					case "element":
						$subTypeName = $xmlReader->name;
						break;
					default:
						throw new \RuntimeException("Invalid config for discriminator in $ref");
				}
				if (!isset($subTypeName)) {
					throw new \RuntimeException("Unable to find discriminator value");
				}
				if ($discriminatorConfig->getValue($subTypeName)) {
					// OK, there's a more specific type for us.
					$ref = $discriminatorConfig->getValue($subTypeName);
					$currentConfig = $this->_config->getConfigElement($ref);
				}

			} else {
				$currentConfig = null;
			}

		} while (isset($currentConfig));

		try {
			$classReflector = new \ReflectionClass($objectType);
		} catch (\Exception $e) {
			throw new \RuntimeException("Unable to instantiate class of " . $type ." for " . $ref, 0, $e);
		}
		// TODO: handling of constructor args.
		$object = $classReflector->newInstance();

		$objectReflector = new \ReflectionObject($object);


		$unknownProperties = array();
		if ($xmlReader->hasAttributes) {
			while ($xmlReader->moveToNextAttribute()) {
				if (isset($attributes[$xmlReader->name])) {
					$setter = "set" . ucfirst($attributes[$xmlReader->name][0]);
					$refSetter = $objectReflector->getMethod($setter);
					$refSetter->invoke($object, $this->_simpleValueAsType($xmlReader->value, $attributes[$xmlReader->name][1]));
				} else {
					$unknownProperties[$xmlReader->name] = $xmlReader->value;
				}
			}
			$xmlReader->moveToElement();
		}

		if ($xmlReader->isEmptyElement) {
			$xmlReader->next();
			return $object;
		}

		$skipped = false;
		while ($skipped || $xmlReader->read()) {
			$skipped = false;
			switch ($xmlReader->nodeType) {
				case \XMLReader::END_ELEMENT:
					$xmlReader->next();
					return $object;
				case \XMLReader::ELEMENT:
					$skipped = true; // This will always lead to us skipping to the next element
					if (isset($elements[$xmlReader->name])) {
						$setter = "set" . ucfirst($elements[$xmlReader->name][0]);
						$refSetter = $objectReflector->getMethod($setter);
						$refSetter->invoke($object, $this->_elementAsType($xmlReader, $elements[$xmlReader->name][1]));
					} else {
						$unknownProperties[$xmlReader->name] = $xmlReader->readInnerXml();
						$xmlReader->next();
					}
					break;
				case \XMLReader::WHITESPACE:
				case \XMLReader::COMMENT:
				case \XMLReader::SIGNIFICANT_WHITESPACE:
					break;
				default:
					throw new \RuntimeException("Found node of type " . $xmlReader->nodeType . " named " . $xmlReader->name . " of value " . $xmlReader->readString());
			}
		}

		throw new \RuntimeException("Never found end of element for $ref!");
	}

}
