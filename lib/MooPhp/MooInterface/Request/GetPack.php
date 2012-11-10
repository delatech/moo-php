<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class GetPack extends Request
{

    private $_packId;
    /**
     * @var bool
     */
    private $_includePhysicalSpec = true;

    public function __construct()
    {
        parent::__construct("moo.pack.getPack", self::HTTP_GET);
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
     * @param boolean $includePhysicalSpec
     */
    public function setIncludePhysicalSpec($includePhysicalSpec)
    {
        $this->_includePhysicalSpec = (bool)$includePhysicalSpec;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIncludePhysicalSpec()
    {
        return $this->_includePhysicalSpec;
    }

}
