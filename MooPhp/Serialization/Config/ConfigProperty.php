<?php
namespace MooPhp\Serialization\Config;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ConfigProperty extends ConfigBaseType {

	/**
	 * @var \MooPhp\Serialization\Config\Types\PropertyType
	 */
	protected $_type;

	/**
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $type
	 */
	public function __construct($type = null) {
		$this->setType($type);
	}

	/**
	 * @param \MooPhp\Serialization\Config\Types\PropertyType $type
	 * @return \MooPhp\Serialization\Config\ConfigProperty
	 */
	public function setType($type) {
		$this->_type = $type;
		return $this;
	}

	/**
	 * @return \MooPhp\Serialization\Config\Types\PropertyType
	 */
	public function getType() {
		return $this->_type;
	}

}
