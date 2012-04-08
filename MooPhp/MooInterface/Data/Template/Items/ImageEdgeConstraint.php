<?php
namespace MooPhp\MooInterface\Data\Template\Items;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ImageEdgeConstraint {

	/**
	 * @var bool
	 */
	protected $_betweenBleedAndCut;
	/**
	 * @var bool
	 */
	protected $_outside;
	/**
	 * @var bool
	 */
	protected $_betweenCutAndSafe;
	/**
	 * @var bool
	 */
	protected $_insideSafe;

	/**
	 * @return boolean
	 */
	public function getBetweenBleedAndCut() {
		return $this->_betweenBleedAndCut;
	}

	/**
	 * @return boolean
	 */
	public function getBetweenCutAndSafe() {
		return $this->_betweenCutAndSafe;
	}

	/**
	 * @return boolean
	 */
	public function getInsideSafe() {
		return $this->_insideSafe;
	}

	/**
	 * @return boolean
	 */
	public function getOutside() {
		return $this->_outside;
	}

	/**
	 * @param boolean $betweenBleedAndCut
	 */
	public function setBetweenBleedAndCut($betweenBleedAndCut) {
		$this->_betweenBleedAndCut = $betweenBleedAndCut;
	}

	/**
	 * @param boolean $betweenCutAndSafe
	 */
	public function setBetweenCutAndSafe($betweenCutAndSafe) {
		$this->_betweenCutAndSafe = $betweenCutAndSafe;
	}

	/**
	 * @param boolean $insideSafe
	 */
	public function setInsideSafe($insideSafe) {
		$this->_insideSafe = $insideSafe;
	}

	/**
	 * @param boolean $outside
	 */
	public function setOutside($outside) {
		$this->_outside = $outside;
	}

}
