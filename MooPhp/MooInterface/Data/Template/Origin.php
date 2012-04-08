<?php
namespace MooPhp\MooInterface\Data\Template;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Origin {

	protected $_orientation;

	protected $_offsetX;

	protected $_offsetY;

	public function getOffsetX() {
		return $this->_offsetX;
	}

	public function getOffsetY() {
		return $this->_offsetY;
	}

	public function getOrientation() {
		return $this->_orientation;
	}

	public function setOffsetX($offsetX) {
		$this->_offsetX = $offsetX;
	}

	public function setOffsetY($offsetY) {
		$this->_offsetY = $offsetY;
	}

	public function setOrientation($orientation) {
		$this->_orientation = $orientation;
	}

}
