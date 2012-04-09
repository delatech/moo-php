<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class SerializerSpecificOptions {

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param string $type
	 * @return \MooPhp\Serialization\Config\Types\PropertyType
	 */
	public function setType($type) {
		$this->_type = $type;
		return $this;
	}

	protected $_options;

	public function __construct() {
		$this->setType("array");
	}


	public function setOptions($options) {
		$this->_options = $options;
		return $this;
	}

	public function getOptions() {
		return $this->_options;
	}

	public function getOption($name) {
		return $this->_options[$name];
	}

	public function setOption($name, $value) {
		$this->_options[$name] = $value;
		return $this;
	}
}
