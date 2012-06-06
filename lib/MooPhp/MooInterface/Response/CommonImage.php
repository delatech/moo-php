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

    protected $_imageBasketItem;

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
}
