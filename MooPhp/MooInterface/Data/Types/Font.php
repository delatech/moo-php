<?php
namespace MooPhp\MooInterface\Data\Types;
use PhpMarshaller\Config\Annotations\JsonProperty;
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
     * @JsonProperty(type="bool")
	 */
	public function getBold() {
		return $this->_bold;
	}

	/**
	 * @return string
     * @JsonProperty(type="string")
	 */
	public function getFamily() {
		return $this->_family;
	}

	/**
	 * @return boolean
     * @JsonProperty(type="bool")
	 */
	public function getItalic() {
		return $this->_italic;
	}

	/**
	 * @param boolean $bold
     * @JsonProperty(type="bool")
	 */
	public function setBold($bold) {
		$this->_bold = $bold;
	}

	/**
	 * @param string $family
     * @JsonProperty(type="string")
	 */
	public function setFamily($family) {
		$this->_family = $family;
	}

	/**
	 * @param boolean $italic
     * @JsonProperty(type="bool")
	 */
	public function setItalic($italic) {
		$this->_italic = $italic;
	}
}
