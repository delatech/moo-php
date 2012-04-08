<?php
namespace MooPhp\MooInterface\Data\Template\Items;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class TextConstraints {

	/**
	 * @var bool
	 */
	protected $_alignmentFixed;
	/**
	 * @var bool
	 */
	protected $_colourFixed;
	/**
	 * @var bool
	 */
	protected $_pointSizeFixed;
	/**
	 * @var bool
	 */
	protected $_fontFixed;

	/**
	 * @return boolean
	 */
	public function getAlignmentFixed() {
		return $this->_alignmentFixed;
	}

	/**
	 * @return boolean
	 */
	public function getColourFixed() {
		return $this->_colourFixed;
	}

	/**
	 * @return boolean
	 */
	public function getFontFixed() {
		return $this->_fontFixed;
	}

	/**
	 * @return boolean
	 */
	public function getPointSizeFixed() {
		return $this->_pointSizeFixed;
	}

	/**
	 * @param boolean $alignmentFixed
	 */
	public function setAlignmentFixed($alignmentFixed) {
		$this->_alignmentFixed = $alignmentFixed;
	}

	/**
	 * @param boolean $colourFixed
	 */
	public function setColourFixed($colourFixed) {
		$this->_colourFixed = $colourFixed;
	}

	/**
	 * @param boolean $fontFixed
	 */
	public function setFontFixed($fontFixed) {
		$this->_fontFixed = $fontFixed;
	}

	/**
	 * @param boolean $pointSizeFixed
	 */
	public function setPointSizeFixed($pointSizeFixed) {
		$this->_pointSizeFixed = $pointSizeFixed;
	}


}
