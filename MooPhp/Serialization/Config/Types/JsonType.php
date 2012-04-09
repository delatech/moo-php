<?php
namespace MooPhp\Serialization\Config\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class JsonType extends PropertyType {

	public function __construct($value = null) {
		$this->setType("json");
		$this->setValue($value);
	}

	/**
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $value
	 * @return \MooPhp\Serialization\Config\Types\JsonType
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

	/**
	 * @var PropertyType
	 */
	protected $_value;

}
