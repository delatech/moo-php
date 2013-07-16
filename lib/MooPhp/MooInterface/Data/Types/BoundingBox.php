<?php
namespace MooPhp\MooInterface\Data\Types;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonProperty;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlElement;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
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
     * @var float
     */
    protected $_cornerRadius;

    /**
     * @var \MooPhp\MooInterface\Data\Types\Point
     */
    protected $_centre;

    public function __construct($centre = null, $width = null, $height = null, $angle = null, $cornerRadius = null)
    {
        $this->_centre = $centre;
        $this->_width = $width;
        $this->_height = $height;
        $this->_angle = $angle;
        $this->_cornerRadius = $cornerRadius;
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
     * @return float
     * @JsonProperty(type="float")
     */
    public function getCornerRadius()
    {
        return $this->_cornerRadius;
    }

    /**
     * @param float $angle
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setAngle($angle)
    {
        $this->_angle = $angle;
        return $this;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\Point $centre
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(name="center", type="\MooPhp\MooInterface\Data\Types\Point")
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\Point")
     */
    public function setCentre($centre)
    {
        $this->_centre = $centre;
        return $this;
    }

    /**
     * @param float $height
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setHeight($height)
    {
        $this->_height = $height;
        return $this;
    }

    /**
     * @param float $width
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setWidth($width)
    {
        $this->_width = $width;
        return $this;
    }

    /**
     * @param float $_cornerRadius
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(type="float")
     * @XmlElement(type="float")
     */
    public function setCornerRadius($cornerRadius)
    {
        $this->_cornerRadius = $cornerRadius;
        return $this;
    }
}
