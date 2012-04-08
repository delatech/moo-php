<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class CreatePack extends Request {

	private $_product;
	private $_pack;
	private $_trackingId = null;

	public function __construct() {
		$this->_method = "moo.pack.createPack";
	}

	/**
	 * @return string The product type (one of the PackApi consts)
	 */
	public function getProduct() {
		return $this->_product;
	}

	/**
	 * @param string $product The product type (one of the PackApi consts)
	 * @return string
	 */
	public function setProduct($product) {
		$this->_product = $product;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Pack the pack data
	 */
	public function getPack() {
		return $this->_pack;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Pack $pack
	 * @return \MooPhp\MooInterface\Data\Pack
	 */
	public function setPack($pack) {
		$this->_pack = $pack;
	}

	/**
	 * @return string The current tracking ID
	 * @return null
	 */
	public function getTrackingId() {
		return $this->_trackingId;
	}

	/**
	 * @param string|null $trackingId
	 * @return null|string
	 */
	public function setTrackingId($trackingId) {
		$this->_trackingId = $trackingId;
	}

}
