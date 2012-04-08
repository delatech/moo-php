<?php
namespace MooPhp\MooInterface\Data\Types;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class Font {

	public function __construct($family = null, $bold = false, $italic = false) {
		$this->_family = $family;
		$this->_bold = $bold;
		$this->_italic = $italic;
	}


	/**
	 * @var string
	 */
	protected $_family;

	/**
	 * @var bool
	 */
	protected $_bold;

	/**
	 * @var bool
	 */
	protected $_italic;

	/**
	 * @return boolean
	 */
	public function getBold() {
		return $this->_bold;
	}

	/**
	 * @return string
	 */
	public function getFamily() {
		return $this->_family;
	}

	/**
	 * @return boolean
	 */
	public function getItalic() {
		return $this->_italic;
	}

	/**
	 * @param boolean $bold
	 */
	public function setBold($bold) {
		$this->_bold = $bold;
	}

	/**
	 * @param string $family
	 */
	public function setFamily($family) {
		$this->_family = $family;
	}

	/**
	 * @param boolean $italic
	 */
	public function setItalic($italic) {
		$this->_italic = $italic;
	}
}
