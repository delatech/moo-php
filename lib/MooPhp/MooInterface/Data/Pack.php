<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Pack
{

    private $_sidesByType = array();

    public function getSidesByType($type)
    {
        if (!isset($this->_sidesByType[$type])) {
            return array();
        }
        return $this->_sidesByType[$type];
    }

    public function getNextSideNum($type)
    {
        return (max(array_keys($this->getSidesByType($type)) + array(0)) + 1);
    }

    public function getSide($type, $num)
    {
        $sides = $this->getSidesByType($type);
        if (isset($sides[$num])) {
            return $sides[$num];
        } else {
            return null;
        }
    }

    /**
     * Add a side to this pack.
     * It requires a type to be set. If sidenum is unset a new one will be generated.
     * If sidenum is set then it MUST be unique.
     * @param Side $side
     * @return Pack
     * @throws \InvalidArgumentException
     */
    public function addSide(Side $side)
    {
        if ($side->getType() === null) {
            throw new \InvalidArgumentException("Side requires a type");
        }
        if ($side->getSideNum() === null) {
            $side->setSideNum($this->getNextSideNum($side->getType()));
        } else {
            if ($this->getSide($side->getType(), $side->getSideNum())) {
                throw new \InvalidArgumentException("Side num is not unique");
            }
        }
        $this->_sidesByType[$side->getType()][$side->getSideNum()] = $side;
        ksort($this->_sidesByType[$side->getType()]);
        return $this;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Card[] The array of Card in the pack.
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Card[]")
     */
    public function getCards()
    {
        return $this->_cards;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Extra[] The array of extras
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Extra[]")
     */
    public function getExtras()
    {
        return $this->_extras;
    }

    /**
     * @return \MooPhp\MooInterface\Data\ImageBasket
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasket")
     */
    public function getImageBasket()
    {
        return $this->_imageBasket;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getNumCards()
    {
        return $this->_numCards;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getProductCode()
    {
        return $this->_productCode;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getProductVersion()
    {
        return $this->_productVersion;
    }

    /**
     * If you modify the sides you are expected to call setSides()
     * @return \MooPhp\MooInterface\Data\Side[]
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Side[]")
     */
    public function getSides()
    {
        $retval = array();
        foreach ($this->_sidesByType as $sides) {
            $retval = array_merge($retval, $sides);
        }
        return $retval;
    }

    /**
     * @param array|null $cards
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Cards[]")
     */
    public function setCards($cards)
    {
        $this->_cards = $cards;
        return $this;
    }

    /**
     * @param array $extras
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Extras[]")
     */
    public function setExtras($extras)
    {
        $this->_extras = $extras;
        return $this;
    }

    /**
     * @param \MooPhp\MooInterface\Data\ImageBasket $imageBasket
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="\MooPhp\MooInterface\Data\ImageBasket")
     */
    public function setImageBasket($imageBasket)
    {
        $this->_imageBasket = $imageBasket;
        return $this;
    }

    /**
     * @param int $numCards
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="int")
     */
    public function setNumCards($numCards)
    {
        $this->_numCards = $numCards;
        return $this;
    }

    /**
     * @param string $productCode
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="string")
     */
    public function setProductCode($productCode)
    {
        $this->_productCode = $productCode;
        return $this;
    }

    /**
     * @param int $productVersion
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="int")
     */
    public function setProductVersion($productVersion)
    {
        $this->_productVersion = $productVersion;
        return $this;
    }

    /**
     * @param Side[] $sides
     * @return \MooPhp\MooInterface\Data\Pack
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Side[]")
     */
    public function setSides($sides)
    {
        foreach ($sides as $side) {
            $this->_sidesByType[$side->getType()][$side->getSideNum()] = $side;
        }
        foreach ($this->_sidesByType as $type => $sides) {
            ksort($this->_sidesByType[$type]);
        }
        return $this;
    }

    /**
     * @var int Number of cards expected in the pack
     */
    protected $_numCards = null;

    /**
     * @var string The product code
     */
    protected $_productCode = null;

    /**
     * @var int Product version number. At time of writing 1 is always right.
     */
    protected $_productVersion = null;

    /**
     * @var array|null of Card in the pack
     */
    protected $_cards = array();

    /**
     * @var array of Extra
     */
    protected $_extras = null;

    /**
     * @var ImageBasket The basket of images in this pack.
     */
    protected $_imageBasket = null;

}
