<?php
namespace MooPhp\Serialization\Config\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ArrayType extends PropertyType {

	/**
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $key
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $value
	 */
	public function __construct($key = null, $value = null) {
		$this->setKey($key);
		$this->setValue($value);
		$this->setType("array");
	}

	/**
	 * @var \MooPhp\Serialization\Config\Types\PropertyType
	 */
	protected $_key;

	/**
	 * @var \MooPhp\Serialization\Config\Types\PropertyType
	 */
	protected $_value;

	/**
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $key
	 * @return \MooPhp\Serialization\Config\Types\ArrayType
	 */
	public function setKey($key) {
		$this->_key = $key;
		return $this;
	}

	/**
	 * @return \MooPhp\Serialization\Config\Types\PropertyType
	 */
	public function getKey() {
		return $this->_key;
	}

	/**
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $value
	 */
	public function setValue($value) {
		$this->_value = $value;
		return $this;
	}

	/**
	 * @return \MooPhp\Serialization\Config\Types\PropertyType
	 */
	public function getValue() {
		return $this->_value;
	}
}
