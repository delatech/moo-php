<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class UpdatePhysicalSpec extends Request
{

    private $_packId;
    /**
     * @var \MooPhp\MooInterface\Data\PhysicalSpec
     */
    private $_physicalSpec;

    public function __construct()
    {
        parent::__construct("moo.pack.updatePhysicalSpec");
    }

    /**
     * @param string $packId The pack ID
     */
    public function setPackId($packId)
    {
        $this->_packId = $packId;
    }

    public function getPackId()
    {
        return $this->_packId;
    }

    /**
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec
     * @return UpdatePhysicalSpec
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
