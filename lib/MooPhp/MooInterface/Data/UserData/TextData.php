<?php
namespace MooPhp\MooInterface\Data\UserData;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonTypeName;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonTypeName("textData")
 */

class TextData extends Datum
{

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

    public function __construct($linkId = null)
    {
        $this->_type = "textData";
        parent::__construct($linkId);
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getAlignment()
    {
        return $this->_alignment;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\Colour
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Colour")
     */
    public function getColour()
    {
        return $this->_colour;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\Font
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Font")
     */
    public function getFont()
    {
        return $this->_font;
    }

    /**
     * Get the size of the text in whatever units of measurement the template uses.
     * This WILL ALMOST CERTAINLY not return the size in points, despite the name!
     * @return float
     * @JsonProperty(type="float")
     */
    public function getPointSize()
    {
        return $this->_pointSize;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getText()
    {
        return $this->_text;
    }

    /**
     * @param string $alignment
     * @return \MooPhp\MooInterface\Data\UserData\TextData
     * @JsonProperty(type="string")
     */
    public function setAlignment($alignment)
    {
        $this->_alignment = $alignment;
        return $this;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\Colour $colour
     * @return \MooPhp\MooInterface\Data\UserData\TextData
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Colour")
     */
    public function setColour($colour)
    {
        $this->_colour = $colour;
        return $this;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\Font $font
     * @return \MooPhp\MooInterface\Data\UserData\TextData
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\Font")
     */
    public function setFont($font)
    {
        $this->_font = $font;
        return $this;
    }

    /**
     * Set the size of the text in whatever units of measurement the template uses.
     * This WILL ALMOST CERTAINLY not want the size in points, despite the name!
     * @param float $pointSize
     * @return \MooPhp\MooInterface\Data\UserData\TextData
     * @JsonProperty(type="float")
     */
    public function setPointSize($pointSize)
    {
        $this->_pointSize = $pointSize;
        return $this;
    }

    /**
     * @param string $text
     * @return \MooPhp\MooInterface\Data\UserData\TextData
     * @JsonProperty(type="string")
     */
    public function setText($text)
    {
        $this->_text = $text;
        return $this;
    }

}
