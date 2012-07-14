<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

abstract class CommonPack extends Response
{

    protected $_packId;
    protected $_pack;
    protected $_warnings;
    protected $_dropIns;

    /**
     * @var \MooPhp\MooInterface\Data\PhysicalSpec
     */
    private $_physicalSpec;

    /**
     * @return string the builder ID
     */
    public function getPackId()
    {
        return $this->_packId;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Pack
     */
    public function getPack()
    {
        return $this->_pack;
    }

    /**
     * @return \MooPhp\MooInterface\Response\Warning[] Any warnings we've triggered
     */
    public function getWarnings()
    {
        return $this->_warnings;
    }

    /**
     * @return array ArraySerialization of dropin urls we can use at this point
     */
    public function getDropIns()
    {
        return $this->_dropIns;
    }

    /**
     * @param $dropIns
     * @JsonProperty(type="string[string]")
     */
    public function setDropIns($dropIns)
    {
        $this->_dropIns = $dropIns;
    }

    /**
     * @param $pack
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Pack")
     */
    public function setPack($pack)
    {
        $this->_pack = $pack;
    }

    /**
     * @param $packId
     * @JsonProperty(type="string")
     */
    public function setPackId($packId)
    {
        $this->_packId = $packId;
    }

    /**
     * @param $warnings
     * @JsonProperty(type="\MooPhp\MooInterface\Response\Warning[]")
     */
    public function setWarnings($warnings)
    {
        $this->_warnings = $warnings;
    }

    /**
     * @JsonProperty(type="\MooPhp\MooInterface\Data\PhysicalSpec")
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec
     * @return \MooPhp\MooInterface\Response\CommonPack
     */
    public function setPhysicalSpec($physicalSpec)
    {
        $this->_physicalSpec = $physicalSpec;
        return $this;
    }

    /**
     * @return \MooPhp\MooInterface\Data\PhysicalSpec
     */
    public function getPhysicalSpec()
    {
        return $this->_physicalSpec;
    }

}
