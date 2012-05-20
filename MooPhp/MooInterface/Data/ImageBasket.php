<?php
namespace MooPhp\MooInterface\Data;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ImageBasket {

	/**
	 * @var \MooPhp\MooInterface\Data\ImageBasketItem[]
	 */
	protected $_items;

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @var string
	 */
	protected $_name;

	/**
	 * @var boolean
	 */
	protected $_immutable;

	public function addItem(ImageBasketItem $item) {
		$items = $this->getItems();
		$items[] = $item;
		$this->setItems($items);
		return $item;
	}

	/**
	 * @return boolean
     * @JsonProperty(type="bool")
	 */
	public function getImmutable() {
		return $this->_immutable;
	}

    /**
     * @return ImageBasketItem[]
     * @JsonProperty(type="\MooPhp\MooInterface\ImageBasketItem[]")
     */
    public function getItems() {
		return $this->_items;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param boolean $immutable
     * @JsonProperty(type="bool")
	 */
	public function setImmutable($immutable) {
		$this->_immutable = $immutable;
	}

    /**
     * @param $items
     * @JsonProperty(type="\MooPhp\MooInterface\ImageBasketItem[]")
     */
    public function setItems($items) {
		$this->_items = $items;
	}

	/**
	 * @param string $name
     * @JsonProperty(type="string")
	 */
	public function setName($name) {
		$this->_name = $name;
	}

	/**
	 * @param string $type
     * @JsonProperty(type="string")
	 */
	public function setType($type) {
		$this->_type = $type;
	}

}
