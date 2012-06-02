<?php
namespace MooPhp\MooInterface\Data\Template;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class Layout {

	/**
	 * @var int
	 */
	protected $_zIndex;

	/**
	 * @return int
	 */
	public function getZIndex() {
		return $this->_zIndex;
	}

	/**
	 * @param int $zIndex
     * @XmlElement(type="int", name="zIndex")
	 */
	public function setZIndex($zIndex) {
		$this->_zIndex = $zIndex;
	}

}
