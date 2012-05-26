<?php
namespace MooPhp\MooInterface\Data\Types;
use PhpMarshaller\Config\Annotations\JsonProperty;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class BoundingBox {

	/**
	 * @var float
	 */
	protected $_width;

	/**
	 * @var float
	 */
	protected $_height;

	/**
	 * @var float
	 */
	protected $_angle;

	/**
	 * @var \MooPhp\MooInterface\Data\Types\Point
	 */
	protected $_centre;

	public function __construct($centre = null, $width = null, $height = null, $angle = null) {
		$this->_centre = $centre;
		$this->_width = $width;
		$this->_height = $height;
		$this->_angle = $angle;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getAngle() {
		return $this->_angle;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Point
     * @JsonProperty(name="center", type="\MooPhp\MooInterface\Data\Types\Point")
	 */
	public function getCentre() {
		return $this->_centre;
	}


	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getHeight() {
		return $this->_height;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getWidth() {
		return $this->_width;
	}

	/**
	 * @param float $angle
     * @JsonProperty(type="float")
	 */
	public function setAngle($angle) {
		$this->_angle = $angle;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Point $centre
     * @JsonProperty(name="center", type="\MooPhp\MooInterface\Data\Types\Point")
	 */
	public function setCentre($centre) {
		$this->_centre = $centre;
	}

	/**
	 * @param float $height
     * @JsonProperty(type="float")
	 */
	public function setHeight($height) {
		$this->_height = $height;
	}

	/**
	 * @param float $width
     * @JsonProperty(type="float")
	 */
	public function setWidth($width) {
		$this->_width = $width;
	}


}
