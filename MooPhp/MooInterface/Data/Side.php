<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Side {
	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @var int
	 */
	protected $_sideNum;

	/**
	 * @var string
	 */
	protected $_templateCode;

	/**
	 * @var \MooPhp\MooInterface\Data\UserData\Datum[]
	 */
	private $_dataByLinkId = array();

	public function getDatumByLinkId($linkId) {
		if (isset($this->_dataByLinkId[$linkId])) {
			return $this->_dataByLinkId[$linkId];
		}
		return null;
	}

	public function addDatum(\MooPhp\MooInterface\Data\UserData\Datum $datum) {
		if ($datum->getLinkId() === null) {
			throw new \InvalidArgumentException("Datum does not have a link ID set");
		}
		if ($this->getDatumByLinkId($datum->getLinkId())) {
			throw new \InvalidArgumentException("A datum with this link ID already exists");
		}
		$this->_dataByLinkId[$datum->getLinkId()] = $datum;
	}

	public function getData() {
		return array_values($this->_dataByLinkId);
	}

	/**
	 * @return int
	 */
	public function getSideNum() {
		return $this->_sideNum;
	}

	/**
	 * @return string
	 */
	public function getTemplateCode() {
		return $this->_templateCode;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\UserData\Datum[] $data
	 */
	public function setData($data) {
		foreach ($data as $datum) {
			$this->_dataByLinkId[$datum->getLinkId()] = $datum;
		}
	}

	/**
	 * @param int $sideNum
	 */
	public function setSideNum($sideNum) {
		$this->_sideNum = $sideNum;
	}

	/**
	 * @param string $templateCode
	 */
	public function setTemplateCode($templateCode) {
		$this->_templateCode = $templateCode;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->_type = $type;
	}

}
