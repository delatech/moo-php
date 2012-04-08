<?php
namespace MooPhp\MooInterface\Data\UserData;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class BoxData extends Datum {

	/**
	 * @var \MooPhp\MooInterface\Data\Types\Colour
	 */
	protected $_colour;

	public function __construct() {
		$this->_type = "boxData";
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Colour
	 */
	public function getColour() {
		return $this->_colour;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Colour $colour
	 */
	public function setColour($colour) {
		$this->_colour = $colour;
	}

}
