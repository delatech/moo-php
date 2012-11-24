<?php
namespace MooPhp\MooInterface\Data\Types;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class Point
{

    /**
     * @var float
     */
    protected $_x;

    /**
     * @var float
     */
    protected $_y;

    public function __construct($x = null, $y = null)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getX()
    {
        return $this->_x;
    }

    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getY()
    {
        return $this->_y;
    }

    /**
     * @param float $y
     * @return \MooPhp\MooInterface\Data\Types\Point
     * @JsonProperty(type="float")
     * @XmlAttribute(type="float")
     */
    public function setY($y)
    {
        $this->_y = $y;
        return $this;
    }

    /**
     * @param float $x
     * @return \MooPhp\MooInterface\Data\Types\Point
     * @JsonProperty(type="float")
     * @XmlAttribute(type="float")
     */
    public function setX($x)
    {
        $this->_x = $x;
        return $this;
    }

}
