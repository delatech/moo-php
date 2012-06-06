<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class UpdatePhysicalSpec extends Response
{

    protected $_packId;
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
     * @param $packId
     * @JsonProperty(type="string")
     */
    public function setPackId($packId)
    {
        $this->_packId = $packId;
    }

    /**
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec
     * @return \MooPhp\MooInterface\Response\UpdatePhysicalSpec
     * @JsonProperty(type="\MooPhp\MooInterface\Data\PhysicalSpec")
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
