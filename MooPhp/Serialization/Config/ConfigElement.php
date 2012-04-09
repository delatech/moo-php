<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ConfigElement extends ConfigBaseType {

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @var \MooPhp\Serialization\Config\ConfigProperty[]
	 */
	protected $_properties = array();

	/**
	 * @var \MooPhp\Serialization\Config\ElementDiscriminator
	 */
	protected $_discriminator = array();


	public function setProperties($properties) {
		$this->_properties = $properties;
		return $this;
	}

	public function getProperties() {
		return $this->_properties;
	}

	/**
	 * @param string $name
	 * @param \MooPhp\Serialization\Config\ConfigProperty $property
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	public function setProperty($name, $property) {
		$this->_properties[$name] = $property;
		return $this;
	}

	/**
	 * @param $name
	 * @return \MooPhp\Serialization\Config\ConfigProperty
	 */
	public function getProperty($name) {
		return $this->_properties[$name];
	}

	/**
	 * @param string $type
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	public function setType($type) {
		$this->_type = $type;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param \MooPhp\Serialization\Config\ElementDiscriminator $discriminator
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	public function setDiscriminator($discriminator) {
		$this->_discriminator = $discriminator;
		return $this;
	}

	/**
	 * @return \MooPhp\Serialization\Config\ElementDiscriminator
	 */
	public function getDiscriminator() {
		return $this->_discriminator;
	}
}
