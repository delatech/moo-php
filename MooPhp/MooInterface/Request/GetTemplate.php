<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class GetTemplate extends Request {

	private $_templateCode;

	public function __construct() {
		parent::__construct("moo.template.getTemplate");
	}

	/**
	 * @param string $templateCode Template code
	 */
	public function setTemplateCode($templateCode) {
		$this->_templateCode = $templateCode;
	}

	public function getTemplateCode() {
		return $this->_templateCode;
	}

}
