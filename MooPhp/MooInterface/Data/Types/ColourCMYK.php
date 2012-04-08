<?php
namespace MooPhp\MooInterface\Data\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ColourCMYK extends Colour {

	public function __construct($c = 0, $m = 0, $y = 0, $k = 0) {
		$this->_c = $c;
		$this->_m = $m;
		$this->_y = $y;
		$this->_k = $k;
		$this->_type = "CMYK";
	}

	/**
	 * @var float
	 */
	protected $_c;
	/**
	 * @var float
	 */
	protected $_m;
	/**
	 * @var float
	 */
	protected $_y;
	/**
	 * @var float
	 */
	protected $_k;

	public function getColour() {
		return array($this->_c, $this->_m, $this->_y, $this->_k);
	}

	public function setColour($c, $m, $y, $k) {
		$this->_c = $c;
		$this->_m = $m;
		$this->_y = $y;
		$this->_k = $k;
	}

	/**
	 * @param float $c
	 */
	public function setC($c) {
		$this->_c = $c;
	}

	/**
	 * @param float $k
	 */
	public function setK($k) {
		$this->_k = $k;
	}

	/**
	 * @param float $m
	 */
	public function setM($m) {
		$this->_m = $m;
	}

	/**
	 * @param float $y
	 */
	public function setY($y) {
		$this->_y = $y;
	}

	/**
	 * @return float
	 */
	public function getY() {
		return $this->_y;
	}

	/**
	 * @return float
	 */
	public function getM() {
		return $this->_m;
	}

	/**
	 * @return float
	 */
	public function getK() {
		return $this->_k;
	}

	/**
	 * @return float
	 */
	public function getC() {
		return $this->_c;
	}

}
