<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class TextMeasure extends Response
{

    /**
     * @var float
     */
    protected $_textWidth;

    /**
     * @var float
     */
    protected $_textHeight;

    /**
     * @var int
     */
    protected $_numberOfLines;

    /**
     * @var bool
     */
    protected $_fontSubstituted;

    /**
     * @param boolean $fontSubstituted
     * @return TextMeasure
     * @JsonProperty(type="bool")
     */
    public function setFontSubstituted($fontSubstituted)
    {
        $this->_fontSubstituted = $fontSubstituted;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getFontSubstituted()
    {
        return $this->_fontSubstituted;
    }

    /**
     * @param int $numberOfLines
     * @return TextMeasure
     * @JsonProperty(type="int")
     */
    public function setNumberOfLines($numberOfLines)
    {
        $this->_numberOfLines = $numberOfLines;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfLines()
    {
        return $this->_numberOfLines;
    }

    /**
     * @param float $textHeight
     * @return TextMeasure
     * @JsonProperty(type="float")
     */
    public function setTextHeight($textHeight)
    {
        $this->_textHeight = $textHeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getTextHeight()
    {
        return $this->_textHeight;
    }

    /**
     * @param float $textWidth
     * @return TextMeasure
     * @JsonProperty(type="float")
     */
    public function setTextWidth($textWidth)
    {
        $this->_textWidth = $textWidth;
        return $this;
    }

    /**
     * @return float
     */
    public function getTextWidth()
    {
        return $this->_textWidth;
    }


}
