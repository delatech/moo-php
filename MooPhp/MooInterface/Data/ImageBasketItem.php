<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ImageBasketItem {

	/**
	 * @var bool
	 */
	protected $_removable;

	/**
	 * @var string
	 */
	protected $_copyrightOwner;

	/**
	 * @var ImageBasketItemImage[]
	 */
	protected $_imageItemsByType;

	/**
	 * @var bool
	 */
	protected $_croppable;

	/**
	 * @var string
	 */
	protected $_resourceUri;

	/**
	 * @var bool
	 */
	protected $_shouldEnhance;

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @var string
	 */
	protected $_cacheId;

	/**
	 * @param $type
	 * @return \MooPhp\MooInterface\Data\ImageBasketItemImage
	 */
	public function getImageItem($type) {
		if (isset($this->_imageItemsByType[$type])) {
			return $this->_imageItemsByType[$type];
		}
		return null;
	}

	/**
	 * @return string
	 */
	public function getCopyrightOwner() {
		return $this->_copyrightOwner;
	}

	/**
	 * @return boolean
	 */
	public function getCroppable() {
		return $this->_croppable;
	}

	public function getImageItems() {
		return array_values($this->_imageItemsByType);
	}

	/**
	 * @return boolean
	 */
	public function getRemovable() {
		return $this->_removable;
	}

	/**
	 * @return string
	 */
	public function getResourceUri() {
		return $this->_resourceUri;
	}

	/**
	 * @return boolean
	 */
	public function getShouldEnhance() {
		return $this->_shouldEnhance;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @return string
	 */
	public function getCacheId() {
		return $this->_cacheId;
	}

	/**
	 * @param string $cacheId
	 */
	public function setCacheId($cacheId) {
		$this->_cacheId = $cacheId;
	}

	/**
	 * @param string $copyrightOwner
	 */
	public function setCopyrightOwner($copyrightOwner) {
		$this->_copyrightOwner = $copyrightOwner;
	}

	/**
	 * @param boolean $croppable
	 */
	public function setCroppable($croppable) {
		$this->_croppable = $croppable;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\ImageBasketItemImage[] $imageItems
	 */
	public function setImageItems($imageItems) {
		foreach ($imageItems as $imageItem) {
			$this->_imageItemsByType[$imageItem->getType()] = $imageItem;
		}
	}

	/**
	 * @param boolean $removable
	 */
	public function setRemovable($removable) {
		$this->_removable = $removable;
	}

	/**
	 * @param string $resourceUri
	 */
	public function setResourceUri($resourceUri) {
		$this->_resourceUri = $resourceUri;
	}

	/**
	 * @param boolean $shouldEnhance
	 */
	public function setShouldEnhance($shouldEnhance) {
		$this->_shouldEnhance = $shouldEnhance;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->_type = $type;
	}
}
