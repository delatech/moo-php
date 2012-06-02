<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
/**
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
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
     * @JsonProperty(type="int")
	 */
	public function getHeight() {
		return $this->_height;
	}

	/**
     * @JsonProperty(type="string")
	 * @return string
	 */
	public function getResourceUri() {
		return $this->_resourceUri;
	}

	/**
     * @JsonProperty(type="float")
	 * @return float
	 */
	public function getRotation() {
		return $this->_rotation;
	}

	/**
     * @JsonProperty(type="string")
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
     * @JsonProperty(type="int")
	 * @return int
	 */
	public function getWidth() {
		return $this->_width;
	}

	/**
     * @JsonProperty(type="int")
	 * @param int $height
	 */
	public function setHeight($height) {
		$this->_height = $height;
	}

	/**
     * @JsonProperty(type="string")
	 * @param string $resourceUri
	 */
	public function setResourceUri($resourceUri) {
		$this->_resourceUri = $resourceUri;
	}

	/**
     * @JsonProperty(type="float")
	 * @param float $rotation
	 */
	public function setRotation($rotation) {
		$this->_rotation = $rotation;
	}

	/**
     * @JsonProperty(type="string")
	 * @param string $type
	 */
	public function setType($type) {
		$this->_type = $type;
	}

	/**
     * @JsonProperty(type="int")
	 * @param int $width
	 */
	public function setWidth($width) {
		$this->_width = $width;
	}
}

