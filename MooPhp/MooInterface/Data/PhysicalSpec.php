<?php
namespace MooPhp\MooInterface\Data;
use PhpMarshaller\Config\Annotations\JsonProperty;
use PhpMarshaller\Config\Annotations\JsonInclude;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 *
 * @JsonInclude(JsonInclude.Include.NON_NULL)
 */
class PhysicalSpec {

	public function __construct($productType = \MooPhp\MooInterface\MooApi::PRODUCT_TYPE_BUSINESSCARD, $paperClassName = null, $finishingOptionName = null, $packSize = null) {
		$this->_productType = $productType;
		$this->_paperClassName = $paperClassName;
		$this->_finishingOptionName = $finishingOptionName;
		$this->_packSize = $packSize;
	}

	/**
	 * @var string
	 */
	protected $_productType;

	/**
	 * @var string
	 */
	protected $_paperClassName;

	/**
	 * @var string
	 */
	protected $_finishingOptionName;

	/**
	 * @var int
	 */
	protected $_packSize;

	/**
	 * @param string $finishingOptionName
	 * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
	 */
	public function setFinishingOptionName($finishingOptionName) {
		$this->_finishingOptionName = $finishingOptionName;
		return $this;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getFinishingOptionName() {
		return $this->_finishingOptionName;
	}

	/**
	 * @param int $packSize
	 * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="int")
	 */
	public function setPackSize($packSize) {
		$this->_packSize = $packSize;
		return $this;
	}

	/**
	 * @return int
     * @JsonProperty(type="int")
	 */
	public function getPackSize() {
		return $this->_packSize;
	}

	/**
	 * @param string $paperClassName
	 * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
	 */
	public function setPaperClassName($paperClassName) {
		$this->_paperClassName = $paperClassName;
		return $this;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getPaperClassName() {
		return $this->_paperClassName;
	}

	/**
	 * @param string $productType
	 * @return \MooPhp\MooInterface\Data\PhysicalSpec
     * @JsonProperty(type="string")
	 */
	public function setProductType($productType) {
		$this->_productType = $productType;
		return $this;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getProductType() {
		return $this->_productType;
	}
}
