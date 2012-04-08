<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Card {

	/**
	 * @var int
	 */
	protected $_cardNum;

	/**
	 * @var \MooPhp\MooInterface\Data\CardSide[]
	 */
	protected $_cardSides;

	/**
	 * @return int
	 */
	public function getCardNum() {
		return $this->_cardNum;
	}

	public function getCardSides() {
		return $this->_cardSides;
	}

	/**
	 * @param int $cardNum
	 */
	public function setCardNum($cardNum) {
		$this->_cardNum = $cardNum;
	}

	public function setCardSides($cardSides) {
		$this->_cardSides = $cardSides;
	}

}
