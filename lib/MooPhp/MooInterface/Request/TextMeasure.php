<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class TextMeasure extends Request
{

    /**
     * @var string
     */
    private $_text;

    /**
     * @var float size in points
     */
    private $_fontSize;

    /**
     * @var \MooPhp\MooInterface\Data\FontSpec
     */
    private $_fontSpec;

    /**
     * @var float wrap width in mm
     */
    private $_wrappingWidth;

    /**
     * @var float leading multiplier
     */
    private $_leading;

    public function __construct()
    {
        parent::__construct("moo.text.measure", self::HTTP_GET);
    }

    /**
     * @param float $fontSize
     * @return TextMeasure
     */
    public function setFontSize($fontSize)
    {
        $this->_fontSize = $fontSize;
        return $this;
    }

    /**
     * @return float
     */
    public function getFontSize()
    {
        return $this->_fontSize;
    }

    /**
     * @param \MooPhp\MooInterface\Data\FontSpec $fontSpec
     * @return TextMeasure
     */
    public function setFontSpec($fontSpec)
    {
        $this->_fontSpec = $fontSpec;
        return $this;
    }

    /**
     * @return \MooPhp\MooInterface\Data\FontSpec
     */
    public function getFontSpec()
    {
        return $this->_fontSpec;
    }

    /**
     * @param float $leading
     * @return TextMeasure
     */
    public function setLeading($leading)
    {
        $this->_leading = $leading;
        return $this;
    }

    /**
     * @return float
     */
    public function getLeading()
    {
        return $this->_leading;
    }

    /**
     * @param string $text
     * @return TextMeasure
     */
    public function setText($text)
    {
        $this->_text = $text;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->_text;
    }

    /**
     * @param float $wrappingWidth
     * @return TextMeasure
     */
    public function setWrappingWidth($wrappingWidth)
    {
        $this->_wrappingWidth = $wrappingWidth;
        return $this;
    }

    /**
     * @return float
     */
    public function getWrappingWidth()
    {
        return $this->_wrappingWidth;
    }

}
