<?php
namespace MooPhp\MooInterface\Data\Types;
use PhpJsonMarshaller\Config\Annotations\JsonProperty;
use PhpJsonMarshaller\Config\Annotations\JsonTypeName;
use PhpXmlMarshaller\Config\Annotations\XmlElement;
use PhpXmlMarshaller\Config\Annotations\XmlAttribute;
use PhpXmlMarshaller\Config\Annotations\XmlRootElement;
use PhpXmlMarshaller\Config\Annotations\XmlDiscriminatorValue;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 * @JsonTypeName("CMYK")
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 * @XmlDiscriminatorValue("CMYK")
 */
class ColourCMYK extends Colour {

	public function __construct($c = 0, $m = 0, $y = 0, $k = 0) {
		$this->_c = $c;
		$this->_m = $m;
		$this->_y = $y;
		$this->_k = $k;
		$this->_type = "CMYK";
	}

	/**
	 * @var float
	 */
	protected $_c;
	/**
	 * @var float
	 */
	protected $_m;
	/**
	 * @var float
	 */
	protected $_y;
	/**
	 * @var float
	 */
	protected $_k;

	public function getColour() {
		return array($this->_c, $this->_m, $this->_y, $this->_k);
	}

	public function setColour($c, $m, $y, $k) {
		$this->_c = $c;
		$this->_m = $m;
		$this->_y = $y;
		$this->_k = $k;
	}

	/**
	 * @param float $c
     * @JsonProperty(type="float")
     * @XmlElement(name="Cyan", type="float")
	 */
	public function setC($c) {
		$this->_c = $c;
	}

	/**
	 * @param float $k
     * @JsonProperty(type="float")
     * @XmlElement(name="Black", type="float")
	 */
	public function setK($k) {
		$this->_k = $k;
	}

	/**
	 * @param float $m
     * @JsonProperty(type="float")
     * @XmlElement(name="Magenta", type="float")
	 */
	public function setM($m) {
		$this->_m = $m;
	}

	/**
	 * @param float $y
     * @JsonProperty(type="float")
     * @XmlElement(name="Yellow", type="float")
	 */
	public function setY($y) {
		$this->_y = $y;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getY() {
		return $this->_y;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getM() {
		return $this->_m;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getK() {
		return $this->_k;
	}

	/**
	 * @return float
     * @JsonProperty(type="float")
	 */
	public function getC() {
		return $this->_c;
	}

}
