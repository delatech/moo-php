<?php
namespace MooPhp\MooInterface\Data\Template;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Template {

	/**
	 * @var string
	 */
	protected $_templateCode;

	/**
	 * @var string
	 */
	protected $_templateVersion;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Settings
	 */
	protected $_settings;

	/**
	 * @var \MooPhp\MooInterface\Data\Template\Items\Item
	 */
	private $_itemsByLinkIdInZIndexOrder = array();

	public function getItemByLinkId($linkId) {
		if (isset($this->_itemsByLinkIdInZIndexOrder[$linkId])) {
			return $this->_itemsByLinkIdInZIndexOrder[$linkId];
		}
		return null;
	}

	/**
	 * @return string
	 */
	public function getTemplateVersion() {
		return $this->_templateVersion;
	}

	/**
	 * @return string
	 */
	public function getTemplateCode() {
		return $this->_templateCode;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Settings
	 */
	public function getSettings() {
		return $this->_settings;
	}

	/**
	 * @return \MooPhp\MooInterface\Data\Template\Items\Item[]
	 */
	public function getItems() {
		return $this->_itemsByLinkIdInZIndexOrder;
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Items\Item[] $items
	 */
	public function setItems($items) {
		foreach ($items as $item) {
			$this->_itemsByLinkIdInZIndexOrder[$item->getLinkId()] = $item;
		}
		uasort($this->_itemsByLinkIdInZIndexOrder,
			function(\MooPhp\MooInterface\Data\Template\Items\Item $a, \MooPhp\MooInterface\Data\Template\Items\Item $b) {
				return $a->compareZIndexTo($b);
			}
		);
	}

	/**
	 * @param \MooPhp\MooInterface\Data\Template\Settings $settings
	 */
	public function setSettings($settings) {
		$this->_settings = $settings;
	}

	/**
	 * @param string $templateCode
	 */
	public function setTemplateCode($templateCode) {
		$this->_templateCode = $templateCode;
	}

	/**
	 * @param string $templateVersion
	 */
	public function setTemplateVersion($templateVersion) {
		$this->_templateVersion = $templateVersion;
	}

}
