<?php
namespace MooPhp\Serialization;

use \MooPhp\Serialization\Config\Types as Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ArrayConfigConfig {

	public function getConfig() {

		$config = new Config\MarshallerConfig();
		$config->setConfigElement("Root", $this->_getMarshallerConfig());
		$config->setConfigElement("ConfigElement", $this->_getConfigElement());
		$config->setConfigElement("PropertyElement", $this->_getPropertyElement());

		return $config;
	}

	/**
	 * Build the MarshallerConfig root node.
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	protected function _getMarshallerConfig() {
		$elementRefType = new Types\RefType();
		$elementRefType->setRef('ConfigElement');

		$rootType = new Types\ArrayType();
		$rootType->setKey(new Types\StringType())->setValue($elementRefType);

		$rootProperty = new Config\ConfigProperty();
		$rootProperty->setType($rootType);

		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\MarshallerConfig');
		$root->setProperty("config", $rootProperty);

		return $root;
	}

	protected function _getConfigElement() {
		$propertyRefType = new Types\RefType();
		$propertyRefType->setRef('ConfigProperty');

		$propertyArrayType = new Types\ArrayType();
		$propertyArrayType->setKey(new Types\StringType())->setValue($propertyRefType);

		$propertiesProperty = new Config\ConfigProperty();
		$propertiesProperty->setType($propertyArrayType);

		$typeProperty = new Config\ConfigProperty();
		$typeProperty->setType(new Types\StringType());

		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\ConfigElement');
		$root->setProperty("type", $typeProperty);
		$root->setProperty("properties", $propertiesProperty);

		return $root;
	}

	protected function _getPropertyElement() {
		$propertyTypeRefType = new Types\RefType();
		$propertyTypeRefType->setRef('PropertyType');

		$propertyTypeType = new Config\ConfigProperty();
		$propertyTypeType->setType($propertyTypeRefType);

		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\ConfigProperty');
		$root->setProperty("type", $propertyTypeType);

		return $root;
	}

	protected function _getPropertyType() {
		$propertyTypeType = new Config\ConfigProperty();
		$propertyTypeType->setType(new Types\StringType());

		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\PropertyType');
		$root->setProperty("type", $propertyTypeType);

		return $root;
	}

	protected function _getStringType() {
		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\StringType');
		return $root;
	}

	protected function _getIntType() {
		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\IntType');
		return $root;
	}

	protected function _getFloatType() {
		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\FloatType');
		return $root;
	}

	protected function _getBoolType() {
		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\BoolType');
		return $root;
	}

	protected function _getRefType() {
		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\RefType');
		$root->setProperty("ref", new Config\ConfigProperty(new Types\StringType()));
		return $root;
	}

	protected function _getArrayType() {
		$root = new Config\ConfigElement();
		$root->setType('\MooPhp\Serialization\Config\Types\ArrayType');
		$root->setProperty("key", new Config\ConfigProperty(new Types\PropertyType()));
		$root->setProperty("value", new Config\ConfigProperty(new Types\PropertyType()));
		return $root;
	}
}
