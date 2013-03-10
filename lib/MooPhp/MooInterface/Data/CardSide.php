<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonCreator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class CardSide
{

    protected $_sideNum;
    protected $_sideType;

    /**
     * @param string $sideType
     * @param int $sideNum
     * @return \MooPhp\MooInterface\Data\CardSide
     * @JsonCreator({@JsonProperty(name="sideType", type="string"), @JsonProperty(name="sideNum", type="int")})
     */
    public function __construct($sideType, $sideNum)
    {
        $this->_sideType = $sideType;
        $this->_sideNum = $sideNum;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getSideType()
    {
        return $this->_sideType;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getSideNum()
    {
        return $this->_sideNum;
    }

    public function __toString()
    {
        return sprintf("[CardSide type=%s num=%s]", $this->getSideType(), $this->getSideNum());
    }

    /**
     * Instantiate a new CardSide for a Side
     * @param Side $side
     * @return CardSide
     */
    public static function forSide(Side $side)
    {
        $className = get_called_class();
        return new $className($side->getType(), $side->getSideNum());
    }

}
