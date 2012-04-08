<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ImageBasketItemImage {

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @var string
	 */
	protected $_resourceUri;

	/**
	 * @var int
	 */
	protected $_width;

	/**
	 * @var int
	 */
	protected $_height;

	/**
	 * @var float
	 */
	protected $_rotation;

	/**
	 * @return int
	 */
	public function getHeight() {
		return $this->_height;
	}

	/**
	 * @return string
	 */
	public function getResourceUri() {
		return $this->_resourceUri;
	}

	/**
	 * @return float
	 */
	public function getRotation() {
		return $this->_rotation;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @return int
	 */
	public function getWidth() {
		return $this->_width;
	}

	/**
	 * @param int $height
	 */
	public function setHeight($height) {
		$this->_height = $height;
	}

	/**
	 * @param string $resourceUri
	 */
	public function setResourceUri($resourceUri) {
		$this->_resourceUri = $resourceUri;
	}

	/**
	 * @param float $rotation
	 */
	public function setRotation($rotation) {
		$this->_rotation = $rotation;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->_type = $type;
	}

	/**
	 * @param int $width
	 */
	public function setWidth($width) {
		$this->_width = $width;
	}
}

