<?php
namespace MooPhp\Serialization;

use \MooPhp\Serialization\Config\Types as Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ArrayConfigBaseConfig {

	public function getConfig($ns = null) {

		if (!isset($ns)) {
			$ns = __NAMESPACE__ . '\Config';
		}

		$config = new Config\MarshallerConfig();
		$config->setConfigElement("Root", $this->_getMarshallerConfig($ns));
		$config->setConfigElement("ConfigElement", $this->_getConfigElement($ns));
		$config->setConfigElement("ElementDiscriminator", $this->_getElementDiscriminator($ns));
		$config->setConfigElement("PropertyType", $this->_getPropertyType($ns));
		$config->setConfigElement("StringType", $this->_getStringType($ns));
		$config->setConfigElement("IntType", $this->_getIntType($ns));
		$config->setConfigElement("FloatType", $this->_getFloatType($ns));
		$config->setConfigElement("BoolType", $this->_getBoolType($ns));
		$config->setConfigElement("RefType", $this->_getRefType($ns));
		$config->setConfigElement("ArrayType", $this->_getArrayType($ns));
		$config->setConfigElement("JsonType", $this->_getJsonType($ns));
		$config->setConfigElement("SerializerSpecificOptions", $this->_getSerializerSpecificOptions($ns));

		return $config;
	}

	/**
	 * Build the MarshallerConfig root node.
	 * @param string $ns
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	protected function _getMarshallerConfig($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\MarshallerConfig');
		$root->setProperty("config", new Types\ArrayType(new Types\StringType(), new Types\RefType('ConfigElement')));

		return $root;
	}

	protected function _getConfigElement($ns) {

		$root = new Config\ConfigElement();
		$root->setType($ns . '\ConfigElement');
		$root->setProperty("type", new Types\StringType());
		$root->setProperty("properties", new Types\ArrayType(new Types\StringType(), new Types\RefType("PropertyType")));
		$root->setProperty("discriminator", (new Types\RefType("ElementDiscriminator")));
		$root->setProperty("options", (new Types\ArrayType(new Types\StringType(), new Types\RefType("SerializerSpecificOptions"))));
		$root->setProperty("constructorArgs", new Types\ArrayType(new Types\IntType(), new Types\StringType()));

		return $root;
	}

	protected function _getElementDiscriminator($ns) {

		$root = new Config\ConfigElement();
		$root->setType($ns . '\ElementDiscriminator');
		$root->setProperty("property", (new Types\StringType()));
		$root->setProperty("values", (new Types\ArrayType(new Types\StringType(), new Types\StringType())));
		$root->setProperty("options", (new Types\ArrayType(new Types\StringType(), new Types\RefType("SerializerSpecificOptions"))));

		return $root;
	}

	protected function _getPropertyType($ns) {

		$discriminator = new Config\ElementDiscriminator();
		$discriminator->setProperty("type");
		$discriminator->setValue("string", "StringType");
		$discriminator->setValue("int", "IntType");
		$discriminator->setValue("float", "FloatType");
		$discriminator->setValue("bool", "BoolType");
		$discriminator->setValue("ref", "RefType");
		$discriminator->setValue("array", "ArrayType");
		$discriminator->setValue("json", "JsonType");

		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\PropertyType');
		$root->setProperty("type", new Types\StringType());
		$root->setDiscriminator($discriminator);
		$root->setProperty("options", (new Types\ArrayType(new Types\StringType(), new Types\RefType("SerializerSpecificOptions"))));

		return $root;
	}

	protected function _getStringType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\StringType');
		return $root;
	}

	protected function _getIntType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\IntType');
		return $root;
	}

	protected function _getFloatType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\FloatType');
		return $root;
	}

	protected function _getBoolType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\BoolType');
		return $root;
	}

	protected function _getRefType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\RefType');
		$root->setProperty("ref", new Types\StringType());
		return $root;
	}

	protected function _getArrayType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\ArrayType');
		$root->setProperty("key", new Types\RefType("PropertyType"));
		$root->setProperty("value", new Types\RefType("PropertyType"));
		return $root;
	}

	protected function _getJsonType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\JsonType');
		$root->setProperty("value", new Types\RefType("PropertyType"));
		return $root;
	}

	protected function _getSerializerSpecificOptions($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\SerializerSpecificOptions');
		$root->setProperty("options", new Types\ArrayType(new Types\StringType(), new Types\StringType()));
		return $root;
	}


	public static function getParsedConfig($configFile) {
		$configuration = new ArrayConfigBaseConfig();
		$marshaller = new ArrayMarshaller($configuration->getConfig());
		return $marshaller->unmarshall(json_decode(file_get_contents($configFile), true), "Root");
	}

}
