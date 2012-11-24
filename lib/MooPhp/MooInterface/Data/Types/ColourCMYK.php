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
 * @JsonTypeName("CMYK")
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 * @XmlDiscriminatorValue("CMYK")
 */
class ColourCMYK extends Colour
{

    public function __construct($c = 0, $m = 0, $y = 0, $k = 0)
    {
        $this->_c = $c;
        $this->_m = $m;
        $this->_y = $y;
        $this->_k = $k;
        $this->_type = "CMYK";
    }

    /**
     * @var float
     */
    protected $_c;
    /**
     * @var float
     */
    protected $_m;
    /**
     * @var float
     */
    protected $_y;
    /**
     * @var float
     */
    protected $_k;

    public function getColour()
    {
        return array($this->_c,
                     $this->_m,
                     $this->_y,
                     $this->_k
        );
    }

    public function setColour($c, $m, $y, $k)
    {
        $this->_c = $c;
        $this->_m = $m;
        $this->_y = $y;
        $this->_k = $k;
        return $this;
    }

    /**
     * @param float $c
     * @return \MooPhp\MooInterface\Data\Types\ColourCMYK
     * @JsonProperty(type="float")
     * @XmlElement(name="Cyan", type="float")
     */
    public function setC($c)
    {
        $this->_c = $c;
        return $this;
    }

    /**
     * @param float $k
     * @return \MooPhp\MooInterface\Data\Types\ColourCMYK
     * @JsonProperty(type="float")
     * @XmlElement(name="Black", type="float")
     */
    public function setK($k)
    {
        $this->_k = $k;
        return $this;
    }

    /**
     * @param float $m
     * @return \MooPhp\MooInterface\Data\Types\ColourCMYK
     * @JsonProperty(type="float")
     * @XmlElement(name="Magenta", type="float")
     */
    public function setM($m)
    {
        $this->_m = $m;
        return $this;
    }

    /**
     * @param float $y
     * @return \MooPhp\MooInterface\Data\Types\ColourCMYK
     * @JsonProperty(type="float")
     * @XmlElement(name="Yellow", type="float")
     */
    public function setY($y)
    {
        $this->_y = $y;
        return $this;
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
     * @return float
     * @JsonProperty(type="float")
     */
    public function getM()
    {
        return $this->_m;
    }

    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getK()
    {
        return $this->_k;
    }

    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getC()
    {
        return $this->_c;
    }

}
