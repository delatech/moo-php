<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonInclude;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonInclude(JsonInclude.Include.NON_NULL)
 */
class FontSpec
{

    /**
     * @var string
     */
    protected $_fontFamily;

    /**
     * @var bool
     */
    protected $_bold;

    /**
     * @var bool
     */
    protected $_italic;

    /**
     * @param string $fontFamily
     * @param bool $bold
     * @param bool $italic
     */
    public function __construct($fontFamily, $bold, $italic)
    {
        $this->_fontFamily = $fontFamily;
        $this->_bold = $bold;
        $this->_italic = $italic;
    }

    /**
     * @param boolean $bold
     * @return FontSpec
     * @JsonProperty(type="bool")
     */
    public function setBold($bold)
    {
        $this->_bold = $bold;
        return $this;
    }

    /**
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getBold()
    {
        return $this->_bold;
    }

    /**
     * @param string $fontFamily
     * @return FontSpec
     * @JsonProperty(type="string")
     */
    public function setFontFamily($fontFamily)
    {
        $this->_fontFamily = $fontFamily;
        return $this;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getFontFamily()
    {
        return $this->_fontFamily;
    }

    /**
     * @param boolean $italic
     * @return FontSpec
     * @JsonProperty(type="bool")
     */
    public function setItalic($italic)
    {
        $this->_italic = $italic;
        return $this;
    }

    /**
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getItalic()
    {
        return $this->_italic;
    }

}
