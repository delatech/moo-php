<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Extra {

	/**
	 * @var string
	 */
	protected $_key;

	/**
	 * @var string
	 */
	protected $_value;

	/**
	 * @return string
	 */
	public function getKey() {
		return $this->_key;
	}

	/**
	 * @return string
	 */
	public function getValue() {
		return $this->_value;
	}

	/**
	 * @param string $key
	 */
	public function setKey($key) {
		$this->_key = $key;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value) {
		$this->_value = $value;
	}

}
