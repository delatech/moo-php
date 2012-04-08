<?php
namespace MooPhp\MooInterface\Data\Template\Items;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class BoxItem extends Item {

	/**
	 * @var \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	protected $_clippingBox;

	/**
	 * @var \MooPhp\MooInterface\Data\Types\Colour
	 */
	protected $_colour;

	/**
	 * @var bool
	 */
	protected $_filled;

	public function __construct() {
		$this->setType("Box");
	}

	public function setType($type) {
		if ($type != "Box") {
			throw new \InvalidArgumentException("Attempting to set type of Box to $type.");
		}
		parent::setType($type);
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	public function getClippingBox() {
		return $this->_clippingBox;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Colour
	 */
	public function getColour() {
		return $this->_colour;
	}

	/**
	 * @return boolean
	 */
	public function getFilled() {
		return $this->_filled;
	}

	/**
	 * @param boolean $filled
	 */
	public function setFilled($filled) {
		$this->_filled = $filled;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Colour $colour
	 */
	public function setColour($colour) {
		$this->_colour = $colour;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $clippingBox
	 */
	public function setClippingBox($clippingBox) {
		$this->_clippingBox = $clippingBox;
	}

}
