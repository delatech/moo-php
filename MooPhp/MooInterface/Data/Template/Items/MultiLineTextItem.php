<?php
namespace MooPhp\MooInterface\Data\Template\Items;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class MultiLineTextItem extends TextItem {

	/**
	 * @var float
	 */
	protected $_baselineOffset;

	/**
	 * @var float
	 */
	protected $_leading;

	/**
	 * @var string
	 */
	protected $_verticalAlignment;

	public function __construct() {
		$this->setType("MultiLineText");
	}

	public function setType($type) {
		if ($type != "MultiLineText") {
			throw new \InvalidArgumentException("Attempting to set type of MultiLineText to $type.");
		}
		parent::setType($type);
	}

	/**
	 * @return float
	 */
	public function getBaselineOffset() {
		return $this->_baselineOffset;
	}

	/**
	 * @return float
	 */
	public function getLeading() {
		return $this->_leading;
	}

	/**
	 * @return string
	 */
	public function getVerticalAlignment() {
		return $this->_verticalAlignment;
	}

	/**
	 * @param float $baselineOffset
	 */
	public function setBaselineOffset($baselineOffset) {
		$this->_baselineOffset = $baselineOffset;
	}

	/**
	 * @param float $leading
	 */
	public function setLeading($leading) {
		$this->_leading = $leading;
	}

	/**
	 * @param string $verticalAlignment
	 */
	public function setVerticalAlignment($verticalAlignment) {
		$this->_verticalAlignment = $verticalAlignment;
	}

}
