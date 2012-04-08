<?php
namespace MooPhp\MooInterface\Response;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Warning {

	private $_element;
	private $_code;
	private $_message;

	/**
	 * @return string
	 */
	public function getElement() {
		return $this->_element;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->_code;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->_message;
	}

	public function setCode($code) {
		$this->_code = $code;
	}

	public function setElement($element) {
		$this->_element = $element;
	}

	public function setMessage($message) {
		$this->_message = $message;
	}
}
