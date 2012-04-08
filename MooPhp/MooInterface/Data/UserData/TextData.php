<?php
namespace MooPhp\MooInterface\Data\UserData;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class TextData extends Datum {

	const ALIGN_LEFT = "left";
	const ALIGN_CENTER = "center";
	const ALIGN_RIGHT = "right";

	/**
	 * @var string
	 */
	protected $_text;
	/**
	 * @var \MooPhp\MooInterface\Data\Types\Font
	 */
	protected $_font;
	/**
	 * @var float
	 */
	protected $_pointSize;
	/**
	 * @var \MooPhp\MooInterface\Data\Types\Colour
	 */
	protected $_colour;
	/**
	 * @var string
	 */
	protected $_alignment;

	public function __construct() {
		$this->_type = "textData";
	}

	/**
	 * @return string
	 */
	public function getAlignment() {
		return $this->_alignment;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Colour
	 */
	public function getColour() {
		return $this->_colour;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Font
	 */
	public function getFont() {
		return $this->_font;
	}

	/**
	 * @return float
	 */
	public function getPointSize() {
		return $this->_pointSize;
	}

	/**
	 * @return string
	 */
	public function getText() {
		return $this->_text;
	}

	/**
	 * @param string $alignment
	 */
	public function setAlignment($alignment) {
		$this->_alignment = $alignment;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Colour $colour
	 */
	public function setColour($colour) {
		$this->_colour = $colour;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Font $font
	 */
	public function setFont($font) {
		$this->_font = $font;
	}

	/**
	 * @param float $pointSize
	 */
	public function setPointSize($pointSize) {
		$this->_pointSize = $pointSize;
	}

	/**
	 * @param string $text
	 */
	public function setText($text) {
		$this->_text = $text;
	}

}
