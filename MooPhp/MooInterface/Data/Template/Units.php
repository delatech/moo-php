<?php
namespace MooPhp\MooInterface\Data\Template;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Units {

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
	}

}
