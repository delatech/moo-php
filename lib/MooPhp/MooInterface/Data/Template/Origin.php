<?php
namespace MooPhp\MooInterface\Data\Template;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class Origin
{

    protected $_orientation;

    protected $_offsetX;

    protected $_offsetY;

    public function getOffsetX()
    {
        return $this->_offsetX;
    }

    public function getOffsetY()
    {
        return $this->_offsetY;
    }

    public function getOrientation()
    {
        return $this->_orientation;
    }

    /**
     * @param $offsetX
     * @XmlAttribute(type="int")
     */
    public function setOffsetX($offsetX)
    {
        $this->_offsetX = $offsetX;
    }

    /**
     * @param $offsetY
     * @XmlAttribute(type="int")
     */
    public function setOffsetY($offsetY)
    {
        $this->_offsetY = $offsetY;
    }

    /**
     * @param $orientation
     * @XmlAttribute(type="string")
     */
    public function setOrientation($orientation)
    {
        $this->_orientation = $orientation;
    }

}
