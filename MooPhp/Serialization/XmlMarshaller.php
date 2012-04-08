<?php
namespace MooPhp\Serialization;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class XmlMarshaller implements Marshaller {

	private $_config;

	public function __construct(array $configArray) {
		$this->_config = $configArray;
	}

	protected function _simpleValueAsType($value, $type) {
		if (!isset($value)) {
			return null;
		}

		if (is_array($type)) {
			throw new \RuntimeException("Complex types not supported for simple values");
		} else {
			switch ($type) {
				case "string":
					return (string)$value;
					break;
				case "int":
					return (int)$value;
					break;
				case "bool":
					return (bool)$value;
					break;
				case "float":
					return (float)$value;
					break;
			}
		}
		throw new \RuntimeException("Failed");
	}

	protected function _elementAsType(\XMLReader $xmlReader, $type) {
		if (is_array($type)) {
			// Complex type
			list($realType, $typeConfig) = $type;

			if ($realType == "ref") {
				return $this->_unmarshall($xmlReader, $typeConfig);
			} elseif ($realType == "array") {
				$data = array();
				while ($xmlReader->read()) {
					switch ($xmlReader->nodeType) {
						case \XMLReader::ELEMENT:
							$data[] = $this->_elementAsType($xmlReader, $typeConfig);
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
				throw new \RuntimeException("Array never ended");
			} else {
				throw new \RuntimeException("I do not understand configured type $realType");
			}

		} else {
			$data = $xmlReader->readInnerXml();
			$ret = $this->_simpleValueAsType($data, $type);
			$xmlReader->next();
			return $ret;
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
		$xmlReader->read();
		if($xmlReader->nodeType != \XMLReader::ELEMENT) {
			$xmlReader->close();
			throw new \RuntimeException("It has all gone horribly wrong");
		}
		$retval = $this->_unmarshall($xmlReader, $ref);
		$xmlReader->close();
		return $retval;
	}

	protected function _unmarshall(\XMLReader $xmlReader, $ref) {


		$attributes = array();
		$elements = array();

		$currentConfig = $this->_config[$ref];
		do {
			// We need to build up the full properties list, and our actual type, from the children.
			$type = $currentConfig["type"];
			if (isset($currentConfig["properties"])) {
				$properties = $currentConfig["properties"];
			} else {
				$properties = array();
			}
			if (!isset($type)) {
				throw new \RuntimeException("Config file error for $ref");
			}

			foreach ($properties as $property => $details) {
				if (isset($details["element"])) {
					$elements[$details["element"]] = array($property, $details["type"]);
				} elseif (isset($details["attribute"])) {
					$attributes[$details["attribute"]] = array($property, $details["type"]);
				} else {
					throw new \RuntimeException("Invalid config for $property");
				}
			}

			if (isset($currentConfig["discriminator"])) {
				$discriminatorConfig = $currentConfig["discriminator"];

				if ($discriminatorConfig["type"] == "attribute") {
					$subTypeKey = $discriminatorConfig["name"];
					$subTypeName = $xmlReader->getAttribute($subTypeKey);
				} elseif ($discriminatorConfig["type"] == "element") {
					$subTypeName = $xmlReader->name;
				} else {
					throw new \RuntimeException("Invalid discriminator type");
				}
				if (!isset($subTypeName)) {
					throw new \RuntimeException("Unable to find discriminator value");
				}
				if (isset($discriminatorConfig["values"][$subTypeName])) {
					// OK, there's a more specific type for us.
					$ref = $discriminatorConfig["values"][$subTypeName];
					$currentConfig = $this->_config[$ref];
				}

			} else {
				$currentConfig = null;
			}

		} while (isset($currentConfig));

		try {
			$classReflector = new \ReflectionClass($type);
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
