<?php
namespace MooPhp\MooInterface\Data\UserData;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ImageData extends Datum {

	/**
	 * @var string
	 */
	protected $_resourceUri;

	/**
	 * @var string
	 */
	protected $_imageStoreFileId;

	/**
	 * @var \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	protected $_imageBox;

	/**
	 * @var bool
	 */
	protected $_enhance;

	public function __construct() {
		$this->_type = "imageData";
	}

	/**
	 * @return boolean
	 */
	public function getEnhance() {
		return $this->_enhance;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	public function getImageBox() {
		return $this->_imageBox;
	}

	/**
	 * @return string
	 */
	public function getImageStoreFileId() {
		return $this->_imageStoreFileId;
	}

	/**
	 * @return string
	 */
	public function getResourceUri() {
		return $this->_resourceUri;
	}

	/**
	 * @param boolean $enhance
	 */
	public function setEnhance($enhance) {
		$this->_enhance = $enhance;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $imageBox
	 */
	public function setImageBox($imageBox) {
		$this->_imageBox = $imageBox;
	}

	/**
	 * @param string $imageStoreFileId
	 */
	public function setImageStoreFileId($imageStoreFileId) {
		$this->_imageStoreFileId = $imageStoreFileId;
	}

	/**
	 * @param string $resourceUri
	 */
	public function setResourceUri($resourceUri) {
		$this->_resourceUri = $resourceUri;
	}

}
