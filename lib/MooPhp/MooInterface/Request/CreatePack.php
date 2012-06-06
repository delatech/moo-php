<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class CreatePack extends Request
{

    /**
     * @var string
     */
    private $_product;

    /**
     * @var \MooPhp\MooInterface\Data\Pack
     */
    private $_pack;

    /**
     * @var string
     */
    private $_trackingId = null;

    /**
     * @var string
     */
    private $_friendlyName = null;

    /**
     * @var string
     */
    private $_startAgainUrl = null;

    /**
     * @var \MooPhp\MooInterface\Data\PhysicalSpec
     */
    private $_physicalSpec;

    /**
     * @var bool
     */
    private $_includePhysicalSpec = true;

    public function __construct()
    {
        $this->_method = "moo.pack.createPack";
    }

    /**
     * @return string The product type (one of the PackApi consts)
     */
    public function getProduct()
    {
        return $this->_product;
    }

    /**
     * @param string $product The product type (one of the PackApi consts)
     * @return string
     */
    public function setProduct($product)
    {
        $this->_product = $product;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Pack the pack data
     */
    public function getPack()
    {
        return $this->_pack;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Pack $pack
     * @return \MooPhp\MooInterface\Data\Pack
     */
    public function setPack($pack)
    {
        $this->_pack = $pack;
    }

    /**
     * @return string The current tracking ID
     * @return null
     */
    public function getTrackingId()
    {
        return $this->_trackingId;
    }

    /**
     * @param string|null $trackingId
     * @return null|string
     */
    public function setTrackingId($trackingId)
    {
        $this->_trackingId = $trackingId;
    }

    /**
     * @param string $friendlyName
     */
    public function setFriendlyName($friendlyName)
    {
        $this->_friendlyName = $friendlyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFriendlyName()
    {
        return $this->_friendlyName;
    }

    /**
     * @param boolean $includePhysicalSpec
     */
    public function setIncludePhysicalSpec($includePhysicalSpec)
    {
        $this->_includePhysicalSpec = $includePhysicalSpec;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIncludePhysicalSpec()
    {
        return $this->_includePhysicalSpec;
    }

    /**
     * @param \MooPhp\MooInterface\Data\PhysicalSpec $physicalSpec
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

    /**
     * @param string $startAgainUrl
     */
    public function setStartAgainUrl($startAgainUrl)
    {
        $this->_startAgainUrl = $startAgainUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartAgainUrl()
    {
        return $this->_startAgainUrl;
    }

}
