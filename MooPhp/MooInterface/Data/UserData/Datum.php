<?php
namespace MooPhp\MooInterface\Data\UserData;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Datum {

	public function getLinkId() {
		return $this->_linkId;
	}

	/**
	 * @param string $linkId
	 */
	public function setLinkId($linkId) {
		$this->_linkId = $linkId;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->_type = $type;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @var string
	 */
	protected $_linkId;

}
