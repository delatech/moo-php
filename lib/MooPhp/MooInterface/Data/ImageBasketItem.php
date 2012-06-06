<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class ImageBasketItem
{

    /**
     * @var bool
     */
    protected $_removable;

    /**
     * @var string
     */
    protected $_copyrightOwner;

    /**
     * @var ImageBasketItemImage[]
     */
    protected $_imageItemsByType;

    /**
     * @var bool
     */
    protected $_croppable;

    /**
     * @var string
     */
    protected $_resourceUri;

    /**
     * @var bool
     */
    protected $_shouldEnhance;

    /**
     * @var string
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_cacheId;

    /**
     * @param $type
     * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function getImageItem($type)
    {
        if (isset($this->_imageItemsByType[$type])) {
            return $this->_imageItemsByType[$type];
        }
        return null;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getCopyrightOwner()
    {
        return $this->_copyrightOwner;
    }

    /**
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getCroppable()
    {
        return $this->_croppable;
    }

    /**
     * @return array
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasketItemImage[]")
     */
    public function getImageItems()
    {
        return array_values($this->_imageItemsByType);
    }

    /**
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getRemovable()
    {
        return $this->_removable;
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
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getShouldEnhance()
    {
        return $this->_shouldEnhance;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getCacheId()
    {
        return $this->_cacheId;
    }

    /**
     * @param string $cacheId
     * @JsonProperty(type="string")
     */
    public function setCacheId($cacheId)
    {
        $this->_cacheId = $cacheId;
    }

    /**
     * @param string $copyrightOwner
     * @JsonProperty(type="string")
     */
    public function setCopyrightOwner($copyrightOwner)
    {
        $this->_copyrightOwner = $copyrightOwner;
    }

    /**
     * @param boolean $croppable
     * @JsonProperty(type="bool")
     */
    public function setCroppable($croppable)
    {
        $this->_croppable = $croppable;
    }

    /**
     * @param \MooPhp\MooInterface\Data\ImageBasketItemImage[] $imageItems
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasketItemImage[]")
     */
    public function setImageItems($imageItems)
    {
        foreach ($imageItems as $imageItem) {
            $this->_imageItemsByType[$imageItem->getType()] = $imageItem;
        }
    }

    /**
     * @param boolean $removable
     * @JsonProperty(type="bool")
     */
    public function setRemovable($removable)
    {
        $this->_removable = $removable;
    }

    /**
     * @param string $resourceUri
     * @JsonProperty(type="string")
     */
    public function setResourceUri($resourceUri)
    {
        $this->_resourceUri = $resourceUri;
    }

    /**
     * @param boolean $shouldEnhance
     * @JsonProperty(type="bool")
     */
    public function setShouldEnhance($shouldEnhance)
    {
        $this->_shouldEnhance = $shouldEnhance;
    }

    /**
     * @param string $type
     * @JsonProperty(type="string")
     */
    public function setType($type)
    {
        $this->_type = $type;
    }
}
