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
		$config->setConfigElement("PropertyElement", $this->_getPropertyElement($ns));
		$config->setConfigElement("ElementDiscriminator", $this->_getElementDiscriminator($ns));
		$config->setConfigElement("PropertyType", $this->_getPropertyType($ns));
		$config->setConfigElement("StringType", $this->_getStringType($ns));
		$config->setConfigElement("IntType", $this->_getIntType($ns));
		$config->setConfigElement("FloatType", $this->_getFloatType($ns));
		$config->setConfigElement("BoolType", $this->_getBoolType($ns));
		$config->setConfigElement("RefType", $this->_getRefType($ns));
		$config->setConfigElement("ArrayType", $this->_getArrayType($ns));
		$config->setConfigElement("SerializerSpecificOptions", $this->_getSerializerSpecificOptions($ns));

		return $config;
	}

	/**
	 * Build the MarshallerConfig root node.
	 * @param string $ns
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	protected function _getMarshallerConfig($ns) {
		$elementRefType = new Types\RefType();
		$elementRefType->setRef('ConfigElement');

		$rootType = new Types\ArrayType();
		$rootType->setKey(new Types\StringType())->setValue($elementRefType);

		$rootProperty = new Config\ConfigProperty();
		$rootProperty->setType($rootType);

		$root = new Config\ConfigElement();
		$root->setType($ns . '\MarshallerConfig');
		$root->setProperty("config", $rootProperty);

		return $root;
	}

	protected function _getConfigElement($ns) {
		$propertyRefType = new Types\RefType();
		$propertyRefType->setRef('PropertyElement');

		$propertyArrayType = new Types\ArrayType();
		$propertyArrayType->setKey(new Types\StringType())->setValue($propertyRefType);

		$propertiesProperty = new Config\ConfigProperty();
		$propertiesProperty->setType($propertyArrayType);

		$typeProperty = new Config\ConfigProperty();
		$typeProperty->setType(new Types\StringType());

		$root = new Config\ConfigElement();
		$root->setType($ns . '\ConfigElement');
		$root->setProperty("type", $typeProperty);
		$root->setProperty("properties", $propertiesProperty);
		$root->setProperty("discriminator", new Config\ConfigProperty(new Types\RefType("ElementDiscriminator")));
		$root->setProperty("options", new Config\ConfigProperty(new Types\RefType("SerializerSpecificOptions")));

		return $root;
	}

	protected function _getElementDiscriminator($ns) {

		$root = new Config\ConfigElement();
		$root->setType($ns . '\ElementDiscriminator');
		$root->setProperty("property", new Config\ConfigProperty(new Types\StringType()));
		$root->setProperty("values", new Config\ConfigProperty(new Types\ArrayType(new Types\StringType(), new Types\StringType())));
		$root->setProperty("options", new Config\ConfigProperty(new Types\RefType("SerializerSpecificOptions")));

		return $root;
	}

	protected function _getPropertyElement($ns) {
		$propertyTypeRefType = new Types\RefType('PropertyType');

		$propertyTypeType = new Config\ConfigProperty();
		$propertyTypeType->setType($propertyTypeRefType);

		$root = new Config\ConfigElement();
		$root->setType($ns . '\ConfigProperty');
		$root->setProperty("type", $propertyTypeType);
		$root->setProperty("options", new Config\ConfigProperty(new Types\RefType("SerializerSpecificOptions")));

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

		$propertyTypeType = new Config\ConfigProperty();
		$propertyTypeType->setType(new Types\StringType());

		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\PropertyType');
		$root->setProperty("type", $propertyTypeType);
		$root->setDiscriminator($discriminator);
		$root->setProperty("options", new Config\ConfigProperty(new Types\RefType("SerializerSpecificOptions")));

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
		$root->setProperty("ref", new Config\ConfigProperty(new Types\StringType()));
		return $root;
	}

	protected function _getArrayType($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\Types\ArrayType');
		$root->setProperty("key", new Config\ConfigProperty(new Types\PropertyType()));
		$root->setProperty("value", new Config\ConfigProperty(new Types\PropertyType()));
		return $root;
	}

	protected function _getSerializerSpecificOptions($ns) {
		$root = new Config\ConfigElement();
		$root->setType($ns . '\SerializerSpecificOptions');
		$root->setProperty("type", new Config\ConfigProperty(new Types\StringType()));
		$root->setProperty("options", new Config\ConfigProperty(new Types\ArrayType(new Types\StringType(), new Types\StringType())));
		return $root;
	}


}
