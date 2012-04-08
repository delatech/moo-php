<?php
namespace MooPhp\MooInterface\Data\Template;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Layout {

	/**
	 * @var int
	 */
	protected $_zIndex;

	/**
	 * @return int
	 */
	public function getZIndex() {
		return $this->_zIndex;
	}

	/**
	 * @param int $zIndex
	 */
	public function setZIndex($zIndex) {
		$this->_zIndex = $zIndex;
	}

}
