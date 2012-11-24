<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class ImageBasketItemImage
{

    /**
     * @var string
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_resourceUri;

    /**
     * @var int
     */
    protected $_width;

    /**
     * @var int
     */
    protected $_height;

    /**
     * @var float
     */
    protected $_rotation;

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * @JsonProperty(type="string")
     * @return string
     */
    public function getResourceUri()
    {
        return $this->_resourceUri;
    }

    /**
     * @JsonProperty(type="float")
     * @return float
     */
    public function getRotation()
    {
        return $this->_rotation;
    }

    /**
     * @JsonProperty(type="string")
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @JsonProperty(type="int")
     * @return int
     */
    public function getWidth()
    {
        return $this->_width;
    }

    /**
     * @JsonProperty(type="int")
     * @param int $height
     * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function setHeight($height)
    {
        $this->_height = $height;
        return $this;
    }

    /**
     * @JsonProperty(type="string")
     * @param string $resourceUri
     * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function setResourceUri($resourceUri)
    {
        $this->_resourceUri = $resourceUri;
        return $this;
    }

    /**
     * @JsonProperty(type="float")
     * @param float $rotation
     * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function setRotation($rotation)
    {
        $this->_rotation = $rotation;
        return $this;
    }

    /**
     * @JsonProperty(type="string")
     * @param string $type
     * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     * @JsonProperty(type="int")
     * @param int $width
     * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function setWidth($width)
    {
        $this->_width = $width;
        return $this;
    }
}

