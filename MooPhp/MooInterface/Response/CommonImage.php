<?php
namespace MooPhp\MooInterface\Response;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

abstract class CommonImage extends Response {

	protected $_imageBasketItem;

	public function setImageBasketItem($imageBasketItem) {
		$this->_imageBasketItem = $imageBasketItem;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\ImageBasketItem
	 */
	public function getImageBasketItem() {
		return $this->_imageBasketItem;
	}
}
