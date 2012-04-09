<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ConfigBaseType {

	/**
	 * @var \MooPhp\Serialization\Config\SerializerSpecificOptions[]
	 */
	protected $_options = null;

	public function setOptions($serializerSpecificOptions) {
		$this->_options = $serializerSpecificOptions;
		return $this;
	}

	public function getOptions() {
		return $this->_options;
	}

	/**
	 * @param $name
	 * @return \MooPhp\Serialization\Config\SerializerSpecificOptions
	 */
	public function getOption($name) {
		if (!isset($this->_options) || !isset($this->_options[$name])) {
			return null;
		}
		return $this->_options[$name];
	}

	/**
	 * @param $name
	 * @param \MooPhp\Serialization\Config\SerializerSpecificOptions $options
	 * @param string $name
	 * @return \MooPhp\Serialization\Config\ConfigBaseType
	 */
	public function setOption($name, $options) {
		if (!isset($this->_options)) {
			$this->_options = array();
		}
		$this->_options[$name] = $options;
		return $this;
	}
}
