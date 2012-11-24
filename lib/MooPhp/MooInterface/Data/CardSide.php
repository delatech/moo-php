<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

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

    /**
     * @param int $sideNum
     * @return \MooPhp\MooInterface\Data\CardSide
     * @JsonProperty(type="int")
     */
    public function setSideNum($sideNum)
    {
        $this->_sideNum = $sideNum;
        return $this;
    }

    /**
     * @param string $sideType
     * @return \MooPhp\MooInterface\Data\CardSide
     * @JsonProperty(type="string")
     */
    public function setSideType($sideType)
    {
        $this->_sideType = $sideType;
        return $this;
    }

}
