<?php

use MooPhp\Serialization\Config as Config;
use MooPhp\Serialization\Config\Types as Types;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class OldArrayConfigAdaptor {


	protected function _getTypeObject($typeConfig) {
		if (is_array($typeConfig)) {
			$type = $typeConfig[0];
		} else {
			$type = $typeConfig;
		}
		switch ($type) {
			case "string":
				$newProperty = new Types\StringType();
				break;
			case "int":
				$newProperty = new Types\IntType();
				break;
			case "float":
				$newProperty = new Types\FloatType();
				break;
			case "bool":
				$newProperty = new Types\BoolType();
				break;
			case "ref":
				$newProperty = new Types\RefType($typeConfig[1]);
				break;
			case "json":
				$newProperty = new Types\JsonType(new Types\RefType($typeConfig[1]));
				break;
			case "array":
				$typeDetails = $typeConfig[1];
				if (!is_array($typeDetails) || (!isset($typeDetails["key"]) && !isset($typeDetails["value"]))) {
					$keyType = new Types\IntType();
					$valueType = $this->_getTypeObject($typeDetails);
				} else {
					if (isset($typeDetails["key"])) {
						$keyType = $this->_getTypeObject($typeDetails["key"]);
					} else {
						$keyType = new Types\IntType();
					}
					$valueType = $this->_getTypeObject($typeDetails["value"]);
				}
				$newProperty = new Types\ArrayType($keyType, $valueType);
				break;
			default:
				throw new \RuntimeException("Did not understand type config " . print_r($typeConfig, true));
		}
		return $newProperty;
	}

	protected function _rewriteProperty($key, $property) {
		$newProperty = $this->_getTypeObject($property["type"]);
		if (isset($property["name"]) && $property["name"] != $key) {
			$options = new Config\SerializerSpecificOptions();
			$options->setOption("name", $property["name"]);
			$newProperty->setOption("array", $options);
		}
		if (isset($property["element"]) && $property["element"] != $key) {
			$options = new Config\SerializerSpecificOptions();
			$options->setOption("name", $property["element"]);
			$newProperty->setOption("xml", $options);
		} elseif (isset($property["attribute"])) {
			$options = new Config\SerializerSpecificOptions();
			$options->setOption("type", "attribute");
			if ($property["attribute"] != $key) {
				$options->setOption("name", $property["atrribute"]);
			}
			$newProperty->setOption("xml", $options);
		}
		return $newProperty;
	}

	protected function _rewriteDiscriminator($discriminator) {
		$newDiscrim = new Config\ElementDiscriminator();
		$newDiscrim->setProperty($discriminator["property"]);
		if (isset($discriminator["name"]) && $discriminator["name"] != $discriminator["property"]) {
			$options = new Config\SerializerSpecificOptions();
			$options->setOption("name", $discriminator["name"]);
			$newDiscrim->setOption("array", $options);
			$newDiscrim->setOption("xml", $options);
		}
		if (isset($discriminator["type"]) && $discriminator["type"] != "element") {
			if (!$opts = $newDiscrim->getOption("xml")) {
				$opts = new Config\SerializerSpecificOptions();
			}
			$opts->setOption("type", $discriminator["type"]);
			$newDiscrim->setOption("xml", $opts);
		}
		$newDiscrim->setValues($discriminator["values"]);
		return $newDiscrim;
	}

	protected function _rewriteElement($element) {

		$newElement = new Config\ConfigElement();
		$newElement->setType($element["type"]);
		if (isset($element["properties"])) {
			foreach ($element["properties"] as $key => $property) {
				$newElement->setProperty($key, $this->_rewriteProperty($key, $property));
			}
		}
		if (isset($element["constructorArgs"])) {
			$newElement->setConstructorArgs($element["constructorArgs"]);
		}
		if (isset($element["discriminator"])) {
			$newElement->setDiscriminator($this->_rewriteDiscriminator($element["discriminator"]));
		}
		return $newElement;
	}

	public function convertToNewObjects($config) {

		$newConfig = new Config\MarshallerConfig();
		foreach ($config as $key => $element) {
			$newConfig->setConfigElement($key, $this->_rewriteElement($element));
		}
		return $newConfig;

	}

}

