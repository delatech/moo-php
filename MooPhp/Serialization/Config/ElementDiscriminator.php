<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ElementDiscriminator extends ConfigBaseType {

	/**
	 * @var string
	 */
	protected $_property;

	/**
	 * @var string[]
	 */
	protected $_values;

	/**
	 * @param string $property
	 * @return \MooPhp\Serialization\Config\ElementDiscriminator
	 */
	public function setProperty($property) {
		$this->_property = $property;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getProperty() {
		return $this->_property;
	}

	/**
	 * @param string $name
	 * @param string $value
	 */
	public function setValue($name, $value) {
		$this->_values[$name] = $value;
	}

	/**
	 * @param string $name
	 * @return string
	 */
	public function getValue($name) {
		if (!isset($this->_values[$name])) {
			return null;
		}
		return $this->_values[$name];
	}

	/**
	 * @param string[] $values
	 * @return ElementDiscriminator
	 */
	public function setValues($values) {
		$this->_values = $values;
		return $this;
	}

	/*
	 *  @return string[]
	 */
	public function getValues() {
		return $this->_values;
	}
}
