<?php
namespace MooPhp\MooInterface\Response;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class AddToCart extends Response {

	private $_warnings;
	private $_dropIns;

	/**
	 * @return \MooPhp\MooInterface\Warning[] Any warnings we've triggered
	 */
	public function getWarnings() {
		return $this->_warnings;
	}

	/**
	 * @return string[] of dropin urls we can use at this point
	 */
	public function getDropIns() {
		return $this->_dropIns;
	}

	public function setDropIns($dropIns) {
		$this->_dropIns = $dropIns;
	}

	public function setWarnings($warnings) {
		$this->_warnings = $warnings;
	}

}
