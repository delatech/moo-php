<?php
namespace MooPhp\MooInterface\Data\Types;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonTypeName;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlDiscriminatorValue;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 * @JsonTypeName("RGB")
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 * @XmlDiscriminatorValue("RGB")
 */
class ColourRGB extends Colour
{

    public function __construct($r = 255, $g = 255, $b = 255)
    {
        $this->_r = $r;
        $this->_g = $g;
        $this->_b = $b;
        $this->_type = "RGB";
    }

    /**
     * @var int
     */
    protected $_r;
    /**
     * @var int
     */
    protected $_g;
    /**
     * @var int
     */
    protected $_b;

    public function getColour()
    {
        return array($this->_r,
                     $this->_g,
                     $this->_b
        );
    }

    public function setColour($r, $g, $b)
    {
        $this->_r = $r;
        $this->_g = $g;
        $this->_b = $b;
        return $this;
    }

    /**
     * @param int $b
     * @return \MooPhp\MooInterface\Data\Types\ColourRGB
     * @JsonProperty(type="int")
     * @XmlElement(type="float", name="Blue")
     */
    public function setB($b)
    {
        $this->_b = $b;
        return $this;
    }

    /**
     * @param int $g
     * @return \MooPhp\MooInterface\Data\Types\ColourRGB
     * @JsonProperty(type="int")
     * @XmlElement(type="float", name="Green")
     */
    public function setG($g)
    {
        $this->_g = $g;
        return $this;
    }

    /**
     * @param int $r
     * @return \MooPhp\MooInterface\Data\Types\ColourRGB
     * @JsonProperty(type="int")
     * @XmlElement(type="float", name="Red")
     */
    public function setR($r)
    {
        $this->_r = $r;
        return $this;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getB()
    {
        return $this->_b;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getG()
    {
        return $this->_g;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getR()
    {
        return $this->_r;
    }

}
