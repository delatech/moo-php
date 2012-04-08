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
	 */
	public function getImmutable() {
		return $this->_immutable;
	}

	public function getItems() {
		return $this->_items;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param boolean $immutable
	 */
	public function setImmutable($immutable) {
		$this->_immutable = $immutable;
	}

	public function setItems($items) {
		$this->_items = $items;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->_name = $name;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->_type = $type;
	}

}
