<?php
namespace MooPhp\MooInterface\Data\Template;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class PrintArea {

	/**
	 * @var float
	 */
	protected $_height;

	/**
	 * @var float
	 */
	protected $_width;

	/**
	 * @return float
	 */
	public function getHeight() {
		return $this->_height;
	}

	/**
	 * @return float
	 */
	public function getWidth() {
		return $this->_width;
	}

	/**
	 * @param float $height
	 */
	public function setHeight($height) {
		$this->_height = $height;
	}

	/**
	 * @param float $width
	 */
	public function setWidth($width) {
		$this->_width = $width;
	}

}
