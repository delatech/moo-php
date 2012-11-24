<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class ImageBasket
{

    /**
     * @var \MooPhp\MooInterface\Data\ImageBasketItem[]
     */
    protected $_items;

    /**
     * @var string
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_name;

    /**
     * @var boolean
     */
    protected $_immutable;

    /**
     * Add an ImageBasketItem to the image basket
     * @param ImageBasketItem $item
     * @return ImageBasket
     */
    public function addItem(ImageBasketItem $item)
    {
        $items = $this->getItems();
        $items[] = $item;
        $this->setItems($items);
        return $this;
    }

    /**
     * @return boolean
     * @JsonProperty(type="bool")
     */
    public function getImmutable()
    {
        return $this->_immutable;
    }

    /**
     * @return ImageBasketItem[]
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasketItem[]")
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getName()
    {
        return $this->_name;
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
     * @param boolean $immutable
     * @return \MooPhp\MooInterface\Data\ImageBasket
     * @JsonProperty(type="bool")
     */
    public function setImmutable($immutable)
    {
        $this->_immutable = $immutable;
        return $this;
    }

    /**
     * @param $items
     * @return \MooPhp\MooInterface\Data\ImageBasket
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasketItem[]")
     */
    public function setItems($items)
    {
        $this->_items = $items;
        return $this;
    }

    /**
     * @param string $name
     * @return \MooPhp\MooInterface\Data\ImageBasket
     * @JsonProperty(type="string")
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * @param string $type
     * @return \MooPhp\MooInterface\Data\ImageBasket
     * @JsonProperty(type="string")
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

}
