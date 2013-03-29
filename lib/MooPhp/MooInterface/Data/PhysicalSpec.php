<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonProperty;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonInclude;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonInclude(JsonInclude::INCLUDE_NON_NULL)
 */
class PhysicalSpec
{

    public function __construct($productType = \MooPhp\MooInterface\MooApi::PRODUCT_TYPE_BUSINESSCARD,
                                $paperClass = null, $finishingOption = null, $packSize = null, $paperLaminate = null)
    {
        $this->_productType = $productType;
        $this->_paperClass = $paperClass;
        $this->_finishingOption = $finishingOption;
        $this->_packSize = $packSize;
        $this->_paperLaminate = $paperLaminate;
    }

    /**
     * @var string
     */
    protected $_paperLaminate;

    /**
     * @var string
     */
    protected $_productType;

    /**
     * @var string
     */
    protected $_paperClass;

    /**
     * @var string
     */
    protected $_finishingOption;

    /**
     * @var int
     */
    protected $_packSize;

    /**
     * @param string $finishingOption
     * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
     */
    public function setFinishingOption($finishingOption)
    {
        $this->_finishingOption = $finishingOption;
        return $this;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getFinishingOption()
    {
        return $this->_finishingOption;
    }

    /**
     * @param int $packSize
     * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="int")
     */
    public function setPackSize($packSize)
    {
        $this->_packSize = $packSize;
        return $this;
    }

    /**
     * @return int
     * @JsonProperty(type="int")
     */
    public function getPackSize()
    {
        return $this->_packSize;
    }

    /**
     * @param string $paperClass
     * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
     */
    public function setPaperClass($paperClass)
    {
        $this->_paperClass = $paperClass;
        return $this;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getPaperClass()
    {
        return $this->_paperClass;
    }

    /**
     * @param string $productType
     * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
     */
    public function setProductType($productType)
    {
        $this->_productType = $productType;
        return $this;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getProductType()
    {
        return $this->_productType;
    }

    /**
     * @param string $paperLaminate
     * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
     */
    public function setPaperLaminate($paperLaminate)
    {
        $this->_paperLaminate = $paperLaminate;
        return $this;
    }

    /**
     * Get the paper laminate name.
     * At time of writing this is NOT documented in the MOO API docs. It should not be relied upon.
     * @return string
     * @JsonProperty(type="string")
     */
    public function getPaperLaminate()
    {
        return $this->_paperLaminate;
    }

}
