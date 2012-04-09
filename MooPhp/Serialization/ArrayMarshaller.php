<?php
namespace MooPhp\Serialization;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ArrayMarshaller implements Marshaller {

	/**
	 * @var \MooPhp\Serialization\Config\MarshallerConfig
	 */
	private $_config;

	public function __construct(Config\MarshallerConfig $config) {
		$this->_config = $config;
	}

	protected function _propertyAsType($data, $type) {
		if (!isset($data)) {
			return null;
		}

		if (is_array($type)) {
			// Complex type
			list($realType, $typeConfig) = $type;

			if ($realType == "ref") {
				return $this->marshall($data, $typeConfig);
			} elseif ($realType == "json") {
				return "".json_encode($this->marshall($data, $typeConfig), JSON_FORCE_OBJECT);
			} elseif ($realType == "array") {
				$converted = array();
				foreach ($data as $key => $value) {
					$convertedKey = $this->_propertyAsType($key, $typeConfig["key"]);
					$convertedValue = $this->_propertyAsType($value, $typeConfig["value"]);
					$converted[$convertedKey] = $convertedValue;
				}
				return $converted;
			}
			throw new \RuntimeException("Unknown complex type $realType");
		}

		switch ($type) {
			case "string":
				return (string)$data;
				break;
			case "int":
				return (int)$data;
				break;
			case "bool":
				return (bool)$data;
				break;
			case "float":
				return (float)$data;
				break;
		}
		throw new \RuntimeException("Unknown type $type");
	}

	/**
	 * @param $data
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $type
	 * @return array|bool|float|int|null|object|string
	 * @throws \RuntimeException
	 */
	protected function _valueAsType($data, $type) {
		if (!isset($data)) {
			return null;
		}


		switch ($type->getType()) {
			case "string":
				return (string)$data;
				break;
			case "int":
				return (int)$data;
				break;
			case "bool":
				return (bool)$data;
				break;
			case "float":
				return (float)$data;
				break;
			case "ref":
				return $this->unmarshall($data, $type->getRef());
			case "json":
				return $this->unmarshall(json_decode($data, true), $type->getRef());
			case "array":
				$converted = array();
				foreach ($data as $key => $value) {
					$convertedKey = $this->_valueAsType($key, $type->getKey());
					$convertedValue = $this->_valueAsType($value, $type->getValue());
					$converted[$convertedKey] = $convertedValue;
				}
				return $converted;
		}
		throw new \RuntimeException("Unknown type $type");
	}

	public function marshall($object, $ref) {
		if (!is_object($object)) {
			throw new \InvalidArgumentException("Got passed non object for marshalling of $ref");
		}

		$reflector = new \ReflectionObject($object);
		$entry = $this->_config->getConfigElement($ref);
		if (!isset($entry)) {
			throw new \RuntimeException("Cannot find config entry for $ref working on " . $reflector->getName());
		}
		/*
		TODO: Work out what to do re implementation type vs base type
		if (!$object instanceof $entry["type"]) {
			throw new \RuntimeException("Object is of invalid type");
		}
		*/
		$marshalled = array();
		foreach ($entry->getProperties() as $property => $details) {
			$getter = "get" . ucfirst($property);
			try {
				$refGetter = $reflector->getMethod($getter);
				$propertyValue = $refGetter->invoke($object);
			} catch (\Exception $e) {
				throw new \RuntimeException("Unable to call getter $getter for $ref", 0, $e);
			}
			$outputName = $details["name"];
			$value = $this->_propertyAsType($propertyValue, $details["type"]);
			if (isset($value)) {
				$marshalled[$outputName] = $value;
			}
		}

		if (isset($entry["discriminator"])) {
			$discriminatorConfig = $entry["discriminator"];
			// OK, this is just a base type...
			$getter = "get" . ucfirst($discriminatorConfig["property"]);
			try {
				$refGetter = $reflector->getMethod($getter);
				$subType = $refGetter->invoke($object);
			} catch (\Exception $e) {
				throw new \RuntimeException("Unable to call getter $getter for $ref", 0, $e);
			}

			if (isset($discriminatorConfig["values"][$subType])) {
				$ref = $discriminatorConfig["values"][$subType];
				// We also need to add the discriminator to the serialized data
				$marshalled[$discriminatorConfig["name"]] = $subType;
				$marshalled += $this->marshall($object, $ref);
			} else {
				// Otherwise we have no idea... serialize as the base type and add
				// the discriminator value
				$marshalled[$discriminatorConfig["name"]] = $subType;
			}

		}
		return $marshalled;

	}

	public function unmarshall($data, $ref) {
		if (!is_array($data)) {
			throw new \InvalidArgumentException("Got passed non array for unmarshalling of $ref");
		}

		$entry = $this->_config->getConfigElement($ref);
		if (!isset($entry)) {
			throw new \RuntimeException("Cannot find config entry for $ref");
		}

		$object = null;
		if ($discriminatorConfig = $entry->getDiscriminator()) {
			// We might not be the real class!
			$subTypeKey = $discriminatorConfig->getProperty();
			if ($discrimOptions = $discriminatorConfig->getOption("array")) {
				if (isset($discrimOptions["name"])) {
					$subTypeKey = $discrimOptions["name"];
				}
			}
			if (isset($data[$subTypeKey])) {
				$subTypeName = $data[$subTypeKey];
				if ($subType = $discriminatorConfig->getValue($subTypeName)) {
					// OK, lets start populating from the top down
					$object = $this->unmarshall($data, $subType);
				}
			}
		}
		$constructorArgConfig = array();
		if (!isset($object)) {
			$args = array();
		/*	if (isset($entry["constructorArgs"])) {
				foreach ($entry["constructorArgs"] as $argName) {
					$argConfig = $entry["properties"][$argName];
					$constructorArgConfig[$argName] = $argConfig;
					$value = isset($data[$argConfig["name"]]) ? $data[$argConfig["name"]] : null;
					$args[] = $this->_valueAsType($value, $argConfig["type"]);
				}
			}*/
			try {
				$classReflector = new \ReflectionClass($entry->getType());
				$object = $classReflector->newInstanceArgs($args);
			} catch (\Exception $e) {
				throw new \RuntimeException("Failed to create instance of " . $entry->getType() . " for $ref", 0, $e);
			}
		}
		if ($discriminatorConfig = $entry->getDiscriminator()) {
			$subTypeKey = $discriminatorConfig->getProperty();
			if ($discrimOptions = $discriminatorConfig->getOption("array")) {
				if (isset($discrimOptions["name"])) {
					$subTypeKey = $discrimOptions["name"];
				}
			}
			if (isset($data[$subTypeKey])) {
				$subTypeName = $data[$subTypeKey];
				$setter = "set" . ucfirst($discriminatorConfig->getProperty());
				try {
					$this->_callSetter($object, $setter, $subTypeName);
				} catch (\RuntimeException $e) {
					throw new \RuntimeException("Error calling $setter while processing $ref");
				}
			}
		}


		$propertiesConfigNameTypeMap = array();
		foreach ($entry->getProperties() as $property => $details) {
			if (isset($constructorArgConfig[$property])) {
				// No need to look it up if it was a constructor arg
				continue;
			}
			$name = $property;
			if ($options = $details->getOption("array")) {
				if (isset($options["name"])) {
					$name = $options["name"];
				}
			}
			$propertiesConfigNameTypeMap[$name] = array($property, $details->getType());
		}

		$unknownProperties = array();
		foreach ($data as $key => $value) {
			if (!isset($propertiesConfigNameTypeMap[$key])) {
				$unknownProperties[$key] = $value;
			} else {
				$setter = "set" . ucfirst($propertiesConfigNameTypeMap[$key][0]);
				$setValue = $this->_valueAsType($value, $propertiesConfigNameTypeMap[$key][1]);
				try {
					$this->_callSetter($object, $setter, $setValue);
				} catch (\RuntimeException $e) {
					throw new \RuntimeException("Error calling $setter while processing $ref");
				}
			}
		}

		return $object;
	}

	private function _callSetter($object, $setter, $value) {
		if (is_callable(array($object, $setter))) {
			// Might be a __call function. Try it and see what happens.
			call_user_func(array($object, $setter), $value);
		} else {
			throw new \RuntimeException("Unable to call $setter on object");
		}
	}

}
