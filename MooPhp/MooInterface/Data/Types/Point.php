<?php
namespace MooPhp\MooInterface\Data\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Point {

	/**
	 * @var float
	 */
	protected $_x;

	/**
	 * @var float
	 */
	protected $_y;

	public function __construct($x = null, $y = null) {
		$this->_x = $x;
		$this->_y = $y;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getX() {
		return $this->_x;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getY() {
		return $this->_y;
	}

	/**
	 * @param float $y
     * @JsonProperty(type="float")
	 */
	public function setY($y) {
		$this->_y = $y;
	}

	/**
	 * @param float $x
     * @JsonProperty(type="float")
	 */
	public function setX($x) {
		$this->_x = $x;
	}

}
