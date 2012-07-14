<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

abstract class CommonImage extends Response
{

    /**
     * @var \MooPhp\MooInterface\Data\ImageBasketItem
     */
    protected $_imageBasketItem;

    /**
     * @var string
     */
    protected $_uploadImageError;

    /**
     * @var ImageWarning[]
     */
    protected $_warnings;

    /**
     * @param $imageBasketItem
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasketItem")
     */
    public function setImageBasketItem($imageBasketItem)
    {
        $this->_imageBasketItem = $imageBasketItem;
    }

    /**
     * @return \MooPhp\MooInterface\Data\ImageBasketItem
     */
    public function getImageBasketItem()
    {
        return $this->_imageBasketItem;
    }

    /**
     * @param string $uploadImageError
     * @return CommonImage
     * @JsonProperty(type="string")
     */
    public function setUploadImageError($uploadImageError)
    {
        $this->_uploadImageError = $uploadImageError;
        return $this;
    }

    /**
     * @return string
     */
    public function getUploadImageError()
    {
        return $this->_uploadImageError;
    }

    /**
     * @param ImageWarning[] $warnings
     * @return CommonImage
     * @JsonProperty(type="\MooPhp\MooInterface\Response\ImageWarning")
     */
    public function setWarnings($warnings)
    {
        $this->_warnings = $warnings;
        return $this;
    }

    /**
     * @return ImageWarning[]
     */
    public function getWarnings()
    {
        return $this->_warnings;
    }


}
