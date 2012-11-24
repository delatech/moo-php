<?php
namespace MooPhp\MooInterface\Data\UserData;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonTypeName;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonTypeName("imageData")
 */

class ImageData extends Datum
{

    /**
     * @var string
     */
    protected $_resourceUri;

    /**
     * @var string
     */
    protected $_imageStoreFileId;

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_imageBox;

    /**
     * @var bool
     */
    protected $_enhance;

    public function __construct($linkId = null)
    {
        $this->_type = "imageData";
        parent::__construct($linkId);
    }

    /**
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getEnhance()
    {
        return $this->_enhance;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function getImageBox()
    {
        return $this->_imageBox;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getImageStoreFileId()
    {
        return $this->_imageStoreFileId;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getResourceUri()
    {
        return $this->_resourceUri;
    }

    /**
     * @param boolean $enhance
     * @return \MooPhp\MooInterface\Data\UserData\ImageData
     * @JsonProperty(type="bool")
     */
    public function setEnhance($enhance)
    {
        $this->_enhance = $enhance;
        return $this;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $imageBox
     * @return \MooPhp\MooInterface\Data\UserData\ImageData
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setImageBox($imageBox)
    {
        $this->_imageBox = $imageBox;
        return $this;
    }

    /**
     * @param string $imageStoreFileId
     * @return \MooPhp\MooInterface\Data\UserData\ImageData
     * @JsonProperty(type="string")
     */
    public function setImageStoreFileId($imageStoreFileId)
    {
        $this->_imageStoreFileId = $imageStoreFileId;
        return $this;
    }

    /**
     * @param string $resourceUri
     * @return \MooPhp\MooInterface\Data\UserData\ImageData
     * @JsonProperty(type="string")
     */
    public function setResourceUri($resourceUri)
    {
        $this->_resourceUri = $resourceUri;
        return $this;
    }

}
