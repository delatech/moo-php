<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class GetPack extends Request {

	private $_packId;

	public function __construct() {
		parent::__construct("moo.pack.getPack");
	}

	/**
	 * @param string $packId The pack ID
	 */
	public function setPackId($packId) {
		$this->_packId = $packId;
	}

	public function getPackId() {
		return $this->_packId;
	}

}
