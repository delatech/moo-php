<?php
namespace MooPhp\MooInterface\Data\Template\Items;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class ImageEdgeConstraint
{

    /**
     * @var bool
     */
    protected $_betweenBleedAndCut;
    /**
     * @var bool
     */
    protected $_outside;
    /**
     * @var bool
     */
    protected $_betweenCutAndSafe;
    /**
     * @var bool
     */
    protected $_insideSafe;

    /**
     * @return boolean
     */
    public function getBetweenBleedAndCut()
    {
        return $this->_betweenBleedAndCut;
    }

    /**
     * @return boolean
     */
    public function getBetweenCutAndSafe()
    {
        return $this->_betweenCutAndSafe;
    }

    /**
     * @return boolean
     */
    public function getInsideSafe()
    {
        return $this->_insideSafe;
    }

    /**
     * @return boolean
     */
    public function getOutside()
    {
        return $this->_outside;
    }

    /**
     * @param boolean $betweenBleedAndCut
     * @XmlAttribute(type="bool")
     */
    public function setBetweenBleedAndCut($betweenBleedAndCut)
    {
        $this->_betweenBleedAndCut = $betweenBleedAndCut;
    }

    /**
     * @param boolean $betweenCutAndSafe
     * @XmlAttribute(type="bool")
     */
    public function setBetweenCutAndSafe($betweenCutAndSafe)
    {
        $this->_betweenCutAndSafe = $betweenCutAndSafe;
    }

    /**
     * @param boolean $insideSafe
     * @XmlAttribute(type="bool")
     */
    public function setInsideSafe($insideSafe)
    {
        $this->_insideSafe = $insideSafe;
    }

    /**
     * @param boolean $outside
     * @XmlAttribute(type="bool")
     */
    public function setOutside($outside)
    {
        $this->_outside = $outside;
    }

}
