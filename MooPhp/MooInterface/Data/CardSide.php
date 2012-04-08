<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class CardSide {

	protected $_sideNum;
	protected $_sideType;

	public function getSideType() {
		return $this->_sideType;
	}

	public function getSideNum() {
		return $this->_sideNum;
	}

	public function setSideNum($sideNum) {
		$this->_sideNum = $sideNum;
	}

	public function setSideType($sideType) {
		$this->_sideType = $sideType;
	}

}
