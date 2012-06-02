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

class Units {

	/**
	 * @var string
	 */
	protected $_type;

	/**
	 * @return string
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param string $type
     * @XmlAttribute(type="string")
	 */
	public function setType($type) {
		$this->_type = $type;
	}

}
