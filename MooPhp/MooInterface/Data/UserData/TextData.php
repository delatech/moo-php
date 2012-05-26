<?php
namespace MooPhp\MooInterface\Data\UserData;
use PhpJsonMarshaller\Config\Annotations\JsonProperty;
use PhpJsonMarshaller\Config\Annotations\JsonTypeName;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 *
 * @JsonTypeName("textData")
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
     * @JsonProperty(type="string")
	 */
	public function getAlignment() {
		return $this->_alignment;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Colour
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Colour")
	 */
	public function getColour() {
		return $this->_colour;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\Font
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Font")
	 */
	public function getFont() {
		return $this->_font;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getPointSize() {
		return $this->_pointSize;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getText() {
		return $this->_text;
	}

	/**
	 * @param string $alignment
     * @JsonProperty(type="string")
	 */
	public function setAlignment($alignment) {
		$this->_alignment = $alignment;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Colour $colour
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Colour")
	 */
	public function setColour($colour) {
		$this->_colour = $colour;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\Font $font
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Font")
	 */
	public function setFont($font) {
		$this->_font = $font;
	}

	/**
	 * @param float $pointSize
     * @JsonProperty(type="float")
	 */
	public function setPointSize($pointSize) {
		$this->_pointSize = $pointSize;
	}

	/**
	 * @param string $text
     * @JsonProperty(type="string")
	 */
	public function setText($text) {
		$this->_text = $text;
	}

}
