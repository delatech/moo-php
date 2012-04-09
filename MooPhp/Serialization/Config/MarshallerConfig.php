<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class MarshallerConfig {

	/**
	 * @var \MooPhp\Serialization\Config\ConfigElement[]
	 */
	private $_configElements;

	/**
	 * @param $name
	 * @return \MooPhp\Serialization\Config\ConfigElement
	 */
	public function getConfigElement($name) {
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

}
