<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonInclude;
use Weasel\JsonMarshaller\Config\Annotations\JsonCreator;

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
     * @JsonCreator({@JsonProperty(name="fontFamily", type="string"), @JsonProperty(name="bold", type="bool"), @JsonProperty(name="italic", type="bool")})
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
