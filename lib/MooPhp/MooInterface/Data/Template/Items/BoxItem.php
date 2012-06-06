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

class BoxItem extends Item
{

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_clippingBox;

    /**
     * @var \MooPhp\MooInterface\Data\Types\Colour
     */
    protected $_colour;

    /**
     * @var bool
     */
    protected $_filled;

    public function __construct()
    {
        $this->setType("Box");
    }

    public function setType($type)
    {
        if ($type != "Box") {
            throw new \InvalidArgumentException("Attempting to set type of Box to $type.");
        }
        parent::setType($type);
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    public function getClippingBox()
    {
        return $this->_clippingBox;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\Colour
     */
    public function getColour()
    {
        return $this->_colour;
    }

    /**
     * @return boolean
     */
    public function getFilled()
    {
        return $this->_filled;
    }

    /**
     * @param boolean $filled
     * @XmlElement(type="bool")
     */
    public function setFilled($filled)
    {
        $this->_filled = $filled;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\Colour $colour
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\Colour")
     */
    public function setColour($colour)
    {
        $this->_colour = $colour;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $clippingBox
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setClippingBox($clippingBox)
    {
        $this->_clippingBox = $clippingBox;
    }

}
