<?php
namespace MooPhp\Serialization\Config\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class PropertyType {

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
	 */
	public function setType($type) {
		$this->_type = $type;
		return $this;
	}
}
