<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Side
{
    /**
     * @var string
     */
    protected $_type;

    /**
     * @var int
     */
    protected $_sideNum;

    /**
     * @var string
     */
    protected $_templateCode;

    /**
     * @var \MooPhp\MooInterface\Data\UserData\Datum[]
     */
    private $_dataByLinkId = array();

    public function getDatumByLinkId($linkId)
    {
        if (isset($this->_dataByLinkId[$linkId])) {
            return $this->_dataByLinkId[$linkId];
        }
        return null;
    }

    public function addDatum(\MooPhp\MooInterface\Data\UserData\Datum $datum)
    {
        if ($datum->getLinkId() === null) {
            throw new \InvalidArgumentException("Datum does not have a link ID set");
        }
        if ($this->getDatumByLinkId($datum->getLinkId())) {
            throw new \InvalidArgumentException("A datum with this link ID already exists");
        }
        $this->_dataByLinkId[$datum->getLinkId()] = $datum;
        return $this;
    }

    /**
     * @JsonProperty(type="\MooPhp\MooInterface\Data\UserData\Datum[]")
     * @return \MooPhp\MooInterface\Data\UserData\Datum[]
     */
    public function getData()
    {
        return array_values($this->_dataByLinkId);
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
     * @return string
     * @JsonProperty(type="string")
     */
    public function getTemplateCode()
    {
        return $this->_templateCode;
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
     * @param \MooPhp\MooInterface\Data\UserData\Datum[] $data
     * @return \MooPhp\MooInterface\Data\Side
     * @JsonProperty(type="\MooPhp\MooInterface\Data\UserData\Datum[]")
     */
    public function setData($data)
    {
        foreach ($data as $datum) {
            $this->_dataByLinkId[$datum->getLinkId()] = $datum;
        }
        return $this;
    }

    /**
     * @param int $sideNum
     * @return \MooPhp\MooInterface\Data\Side
     * @JsonProperty(type="int")
     */
    public function setSideNum($sideNum)
    {
        $this->_sideNum = $sideNum;
        return $this;
    }

    /**
     * @param string $templateCode
     * @return \MooPhp\MooInterface\Data\Side
     * @JsonProperty(type="string")
     */
    public function setTemplateCode($templateCode)
    {
        $this->_templateCode = $templateCode;
        return $this;
    }

    /**
     * @param string $type
     * @return \MooPhp\MooInterface\Data\Side
     * @JsonProperty(type="string")
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

}
