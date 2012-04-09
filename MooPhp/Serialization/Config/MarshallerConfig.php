<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class MarshallerConfig extends ConfigBaseType {

	/**
	 * @var \MooPhp\Serialization\Config\ConfigElement[]
	 */
	private $_configElements;

	/**
	 * @param $name
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	public function getConfigElement($name) {
		if (!isset($this->_configElements[$name])) {
			return null;
		}
		return $this->_configElements[$name];
	}

	/**
	 * @param $name
	 * @param \MooPhp\Serialization\Config\ConfigElement $element
	 */
	public function setConfigElement($name, ConfigElement $element) {
		$this->_configElements[$name] = $element;
		return $this;
	}

	public function setConfig($config) {
		$this->_configElements = $config;
	}

	public function getConfig() {
		return $this->_configElements;
	}

}
