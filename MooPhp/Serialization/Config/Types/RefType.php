<?php
namespace MooPhp\Serialization\Config\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class RefType extends PropertyType {

	public function __construct() {
		$this->setType("ref");
	}
	/**
	 * @var string
	 */
	protected $_ref;

	/**
	 * @param string $ref
	 */
	public function setRef($ref) {
		$this->_ref = $ref;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRef() {
		return $this->_ref;
	}
}
