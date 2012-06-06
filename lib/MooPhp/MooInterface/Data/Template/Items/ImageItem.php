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

class ImageItem extends Item
{

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_clippingBox;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Items\ImageConstraints
     */
    protected $_constraints;

    public function __construct()
    {
        $this->setType("Image");
    }

    public function setType($type)
    {
        if ($type != "Image") {
            throw new \InvalidArgumentException("Attempting to set type of Image to $type.");
        }
        parent::setType($type);
    }

    public function calculateDefaultImageBox($width, $height)
    {
        $clipAspect = $this->getClippingBox()->getWidth() / $this->getClippingBox()->getHeight();
        $imageAspect = $width / $height;

        if ($clipAspect > $imageAspect) {
            $scale = $this->getClippingBox()->getWidth() / $width;
        } else {
            $scale = $this->getClippingBox()->getHeight() / $height;
        }

        $box = new \MooPhp\MooInterface\Data\Types\BoundingBox();
        $box->setWidth($width * $scale);
        $box->setHeight($height * $scale);
        $box->setCentre($this->getClippingBox()->getCentre());

        return $box;

    }


    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    public function getClippingBox()
    {
        return $this->_clippingBox;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Items\ImageConstraints
     */
    public function getConstraints()
    {
        return $this->_constraints;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $clippingBox
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setClippingBox($clippingBox)
    {
        $this->_clippingBox = $clippingBox;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Items\ImageConstraints $constraints
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Items\ImageConstraints")
     */
    public function setConstraints($constraints)
    {
        $this->_constraints = $constraints;
    }

}
