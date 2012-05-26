<?php
namespace MooPhp\MooInterface\Data\Types;
use PhpMarshaller\Config\Annotations\JsonProperty;
use PhpMarshaller\Config\Annotations\JsonTypeName;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 * @JsonTypeName("RGB")
 */
class ColourRGB extends Colour {

	public function __construct($r = 255, $g = 255, $b = 255) {
		$this->_r = $r;
		$this->_g = $g;
		$this->_b = $b;
		$this->_type = "RGB";
	}

	/**
	 * @var int
	 */
	protected $_r;
	/**
	 * @var int
	 */
	protected $_g;
	/**
	 * @var int
	 */
	protected $_b;

	public function getColour() {
		return array($this->_r, $this->_g, $this->_b);
	}

	/**
	 * @param int $b
     * @JsonProperty(type="int")
	 */
	public function setB($b) {
		$this->_b = $b;
	}

	/**
	 * @param int $g
     * @JsonProperty(type="int")
	 */
	public function setG($g) {
		$this->_g = $g;
	}

	/**
	 * @param int $r
     * @JsonProperty(type="int")
	 */
	public function setR($r) {
		$this->_r = $r;
	}

	/**
	 * @return int
     * @JsonProperty(type="int")
	 */
	public function getB() {
		return $this->_b;
	}

	/**
	 * @return int
     * @JsonProperty(type="int")
	 */
	public function getG() {
		return $this->_g;
	}

	/**
	 * @return int
     * @JsonProperty(type="int")
	 */
	public function getR() {
		return $this->_r;
	}

}
