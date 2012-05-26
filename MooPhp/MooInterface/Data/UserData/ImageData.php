<?php
namespace MooPhp\MooInterface\Data\UserData;
use PhpMarshaller\Config\Annotations\JsonProperty;
use PhpMarshaller\Config\Annotations\JsonTypeName;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 *
 * @JsonTypeName("imageData")
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
     * @JsonProperty(type="bool")
	 */
	public function getEnhance() {
		return $this->_enhance;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
	 */
	public function getImageBox() {
		return $this->_imageBox;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getImageStoreFileId() {
		return $this->_imageStoreFileId;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getResourceUri() {
		return $this->_resourceUri;
	}

	/**
	 * @param boolean $enhance
     * @JsonProperty(type="bool")
	 */
	public function setEnhance($enhance) {
		$this->_enhance = $enhance;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $imageBox
     * @JsonProperty(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
	 */
	public function setImageBox($imageBox) {
		$this->_imageBox = $imageBox;
	}

	/**
	 * @param string $imageStoreFileId
     * @JsonProperty(type="string")
	 */
	public function setImageStoreFileId($imageStoreFileId) {
		$this->_imageStoreFileId = $imageStoreFileId;
	}

	/**
	 * @param string $resourceUri
     * @JsonProperty(type="string")
	 */
	public function setResourceUri($resourceUri) {
		$this->_resourceUri = $resourceUri;
	}

}
