<?php
namespace MooPhp\MooInterface\Data\Template;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Settings {

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Units
	 */
	protected $_units;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Origin
	 */
	protected $_origin;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\PrintArea
	 */
	protected $_printArea;

	/**
	 * @var \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	protected $_bleedBox;

	/**
	 * @var \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	protected $_cutBox;

	/**
	 * @var \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	protected $_safeAreaBox;

	/**
	 * @var float
	 */
	protected $_rotationAngle;

	/**
	 * @var string
	 */
	protected $_fontSubstitutionStrategy;

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	public function getBleedBox() {
		return $this->_bleedBox;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	public function getCutBox() {
		return $this->_cutBox;
	}

	/**
	 * @return string
	 */
	public function getFontSubstitutionStrategy() {
		return $this->_fontSubstitutionStrategy;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Origin
	 */
	public function getOrigin() {
		return $this->_origin;
	}

	/**
	 * @var \MooPhp\MooInterface\Data\Template\PrintArea
	 */
	public function getPrintArea() {
		return $this->_printArea;
	}

	/**
	 * @return float
	 */
	public function getRotationAngle() {
		return $this->_rotationAngle;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	public function getSafeAreaBox() {
		return $this->_safeAreaBox;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Units
	 */
	public function getUnits() {
		return $this->_units;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $bleedBox
	 */
	public function setBleedBox($bleedBox) {
		$this->_bleedBox = $bleedBox;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $cutBox
	 */
	public function setCutBox($cutBox) {
		$this->_cutBox = $cutBox;
	}

	/**
	 * @param string $fontSubstitutionStrategy
	 */
	public function setFontSubstitutionStrategy($fontSubstitutionStrategy) {
		$this->_fontSubstitutionStrategy = $fontSubstitutionStrategy;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Origin $origin
	 */
	public function setOrigin($origin) {
		$this->_origin = $origin;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\PrintArea $printArea
	 */
	public function setPrintArea($printArea) {
		$this->_printArea = $printArea;
	}

	/**
	 * @param float $rotationAngle
	 */
	public function setRotationAngle($rotationAngle) {
		$this->_rotationAngle = $rotationAngle;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $safeAreaBox
	 */
	public function setSafeAreaBox($safeAreaBox) {
		$this->_safeAreaBox = $safeAreaBox;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Units $units
	 */
	public function setUnits($units) {
		$this->_units = $units;
	}

}
