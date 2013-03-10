<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Card
{

    /**
     * @var int
     */
    protected $_cardNum;

    /**
     * @var \MooPhp\MooInterface\Data\CardSide[]
     */
    protected $_cardSides;

    /**
     * @param \MooPhp\MooInterface\Data\CardSide[] $cardSides
     * @param int $cardNum
     */
    public function __construct(array $cardSides = array(), $cardNum = null)
    {
        $this->_cardSides = $cardSides;
        $this->_cardNum = $cardNum;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getCardNum()
    {
        return $this->_cardNum;
    }

    /**
     * @return CardSide[]
     * @JsonProperty(type="\MooPhp\MooInterface\Data\CardSide[]")
     */
    public function getCardSides()
    {
        return $this->_cardSides;
    }

    /**
     * @param int $cardNum
     * @return \MooPhp\MooInterface\Data\Card
     * @JsonProperty(type="int")
     */
    public function setCardNum($cardNum)
    {
        $this->_cardNum = $cardNum;
        return $this;
    }

    /**
     * @JsonProperty(type="\MooPhp\MooInterface\Data\CardSide[]")
     * @param $cardSides
     * @return \MooPhp\MooInterface\Data\Card
     */
    public function setCardSides($cardSides)
    {
        $this->_cardSides = $cardSides;
        return $this;
    }

}
