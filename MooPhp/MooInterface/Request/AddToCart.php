<?php
namespace MooPhp\MooInterface\Request;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class AddToCart extends Request {

	/**
	 * @var string
	 */
	private $_packId;

	/**
	 * @var int
	 */
	private $_quantity;

	public function __construct() {
		parent::__construct("moo.pack.addToCart");
	}

	/**
	 * @param string $packId The pack ID
	 */
	public function setPackId($packId) {
		$this->_packId = $packId;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity($quantity) {
		$this->_quantity = $quantity;
	}

	/**
	 * @return string
	 */
	public function getPackId() {
		return $this->_packId;
	}

	/**
	 * @return int
	 */
	public function getQuantity() {
		return $this->_quantity;
	}


}
