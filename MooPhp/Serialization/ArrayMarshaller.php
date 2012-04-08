<?php
namespace MooPhp\Serialization;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ArrayMarshaller implements Marshaller {

	private $_config;

	public function __construct(array $configArray) {
		$this->_config = $configArray;
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

	protected function _valueAsType($data, $type) {
		if (!isset($data)) {
			return null;
		}

		if (is_array($type)) {
			// Complex type
			list($realType, $typeConfig) = $type;

			if ($realType == "ref") {
				return $this->unmarshall($data, $typeConfig);
			} elseif ($realType == "json") {
				return $this->unmarshall(json_decode($data, true), $typeConfig);
			} elseif ($realType == "array") {
				$converted = array();
				foreach ($data as $key => $value) {
					$convertedKey = $this->_valueAsType($key, $typeConfig["key"]);
					$convertedValue = $this->_valueAsType($value, $typeConfig["value"]);
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

	public function marshall($object, $ref) {
		if (!is_object($object)) {
			throw new \InvalidArgumentException("Got passed non object for marshalling of $ref");
		}

		$reflector = new \ReflectionObject($object);
		if (!isset($this->_config[$ref])) {
			throw new \RuntimeException("Cannot find config entry for $ref working on " . $reflector->getName());
		}
		$entry = $this->_config[$ref];
		if (!isset($entry["properties"])) {
			$entry["properties"] = array();
		}
		/*
		TODO: Work out what to do re implementation type vs base type
		if (!$object instanceof $entry["type"]) {
			throw new \RuntimeException("Object is of invalid type");
		}
		*/
		$marshalled = array();
		foreach ($entry["properties"] as $property => $details) {
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

		$entry = $this->_config[$ref];

		$object = null;
		if (isset($entry["discriminator"])) {
			// We might not be the real class!
			$discriminatorConfig = $entry["discriminator"];
			$subTypeKey = $discriminatorConfig["name"];
			if (isset($data[$subTypeKey])) {
				$subTypeName = $data[$subTypeKey];
				if (isset($discriminatorConfig["values"][$subTypeName])) {
					// OK, lets start populating from the top down
					$object = $this->unmarshall($data, $discriminatorConfig["values"][$subTypeName]);
				}
			}
		}
		$constructorArgConfig = array();
		if (!isset($object)) {
			$args = array();
			if (isset($entry["constructorArgs"])) {
				foreach ($entry["constructorArgs"] as $argName) {
					$argConfig = $entry["properties"][$argName];
					$constructorArgConfig[$argName] = $argConfig;
					$value = isset($data[$argConfig["name"]]) ? $data[$argConfig["name"]] : null;
					$args[] = $this->_valueAsType($value, $argConfig["type"]);
				}
			}
			try {
				$classReflector = new \ReflectionClass($entry["type"]);
				$object = $classReflector->newInstanceArgs($args);
			} catch (\Exception $e) {
				throw new \RuntimeException("Failed to create instance of " . $entry["type"] . " for $ref", 0, $e);
			}
		}

		$objectReflector = new \ReflectionObject($object);


		if (!isset($entry["properties"])) {
			$entry["properties"] = array();
		}
		$propertiesConfigNameTypeMap = array();
		foreach ($entry["properties"] as $property => $details) {
			if (isset($constructorArgConfig[$property])) {
				// No need to look it up if it was a constructor arg
				continue;
			}
			$propertiesConfigNameTypeMap[$details["name"]] = array($property, $details["type"]);
		}

		$unknownProperties = array();
		foreach ($data as $key => $value) {
			if (!isset($propertiesConfigNameTypeMap[$key])) {
				$unknownProperties[$key] = $value;
			} else {
				$setter = "set" . ucfirst($propertiesConfigNameTypeMap[$key][0]);
				$refSetter = $objectReflector->getMethod($setter);
				$refSetter->invoke($object, $this->_valueAsType($value, $propertiesConfigNameTypeMap[$key][1]));
			}
		}

		return $object;
	}
}

