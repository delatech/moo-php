<?php
namespace MooPhp\MooInterface\Data\Types;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class BoundingBox
{

    /**
     * @var float
     */
    protected $_width;

    /**
     * @var float
     */
    protected $_height;

    /**
     * @var float
     */
    protected $_angle;

    /**
     * @var \MooPhp\MooInterface\Data\Types\Point
     */
    protected $_centre;

    public function __construct($centre = null, $width = null, $height = null, $angle = null)
    {
        $this->_centre = $centre;
        $this->_width = $width;
        $this->_height = $height;
        $this->_angle = $angle;
    }

    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getAngle()
    {
        return $this->_angle;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\Point
     * @JsonProperty(name="center", type="\MooPhp\MooInterface\Data\Types\Point")
     */
    public function getCentre()
    {
        return $this->_centre;
    }


    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * @return float
     * @JsonProperty(type="float")
     */
    public function getWidth()
    {
        return $this->_width;
    }

    /**
     * @param float $angle
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setAngle($angle)
    {
        $this->_angle = $angle;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\Point $centre
     * @JsonProperty(name="center", type="\MooPhp\MooInterface\Data\Types\Point")
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\Point")
     */
    public function setCentre($centre)
    {
        $this->_centre = $centre;
    }

    /**
     * @param float $height
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setHeight($height)
    {
        $this->_height = $height;
    }

    /**
     * @param float $width
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setWidth($width)
    {
        $this->_width = $width;
    }


}
