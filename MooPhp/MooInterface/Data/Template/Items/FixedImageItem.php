<?php
namespace MooPhp\MooInterface\Data\Template\Items;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class FixedImageItem extends ImageItem {

	/**
	 * @var \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	protected $_imageBox;

	/**
	 * @var string
	 */
	protected $_resourceUri;

	/**
	 * @var string[]
	 */
	protected $_resourceUriChoiceList;

	public function __construct() {
		$this->setType("FixedImage");
	}

	public function setType($type) {
		if ($type != "FixedImage") {
			throw new \InvalidArgumentException("Attempting to set type of FixedImage to $type.");
		}
		parent::setType($type);
	}

	public function getResourceUriChoiceList() {
		return $this->_resourceUriChoiceList;
	}

	public function getResourceUri() {
		return $this->_resourceUri;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Types\BoundingBox
	 */
	public function getImageBox() {
		return $this->_imageBox;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Types\BoundingBox $imageBox
	 */
	public function setImageBox($imageBox) {
		$this->_imageBox = $imageBox;
	}

	/**
	 * @param string $resourceUri
	 */
	public function setResourceUri($resourceUri) {
		$this->_resourceUri = $resourceUri;
	}

	public function setResourceUriChoiceList($resourceUriChoiceList) {
		$this->_resourceUriChoiceList = $resourceUriChoiceList;
	}

}
