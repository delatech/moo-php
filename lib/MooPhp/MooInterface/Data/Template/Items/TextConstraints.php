<?php
namespace MooPhp\MooInterface\Data\Template\Items;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class TextConstraints
{

    /**
     * @var bool
     */
    protected $_alignmentFixed;
    /**
     * @var bool
     */
    protected $_colourFixed;
    /**
     * @var bool
     */
    protected $_pointSizeFixed;
    /**
     * @var bool
     */
    protected $_fontFixed;

    /**
     * @return boolean
     */
    public function getAlignmentFixed()
    {
        return $this->_alignmentFixed;
    }

    /**
     * @return boolean
     */
    public function getColourFixed()
    {
        return $this->_colourFixed;
    }

    /**
     * @return boolean
     */
    public function getFontFixed()
    {
        return $this->_fontFixed;
    }

    /**
     * @return boolean
     */
    public function getPointSizeFixed()
    {
        return $this->_pointSizeFixed;
    }

    /**
     * @param boolean $alignmentFixed
     * @XmlAttribute(type="bool")
     */
    public function setAlignmentFixed($alignmentFixed)
    {
        $this->_alignmentFixed = $alignmentFixed;
    }

    /**
     * @param boolean $colourFixed
     * @XmlAttribute(type="bool")
     */
    public function setColourFixed($colourFixed)
    {
        $this->_colourFixed = $colourFixed;
    }

    /**
     * @param boolean $fontFixed
     * @XmlAttribute(type="bool")
     */
    public function setFontFixed($fontFixed)
    {
        $this->_fontFixed = $fontFixed;
    }

    /**
     * @param boolean $pointSizeFixed
     * @XmlAttribute(type="bool")
     */
    public function setPointSizeFixed($pointSizeFixed)
    {
        $this->_pointSizeFixed = $pointSizeFixed;
    }


}
