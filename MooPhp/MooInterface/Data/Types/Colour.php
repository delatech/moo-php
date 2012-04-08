<?php
namespace MooPhp\MooInterface\Data\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Colour {

	const COLOUR_RGB = "RGB";
	const COLOUR_CMYK = "CMYK";

	protected $_type;

	public function getType() {
		return $this->_type;
	}

	public function setType($type) {
		$this->_type = $type;
	}
}
