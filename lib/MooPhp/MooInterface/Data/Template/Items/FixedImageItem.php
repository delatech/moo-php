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

class FixedImageItem extends ImageItem
{

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_imageBox;

    /**
     * @var string
     */
    protected $_resourceUri;

    /**
     * @var string[]
     */
    protected $_resourceUriChoiceList;

    public function __construct()
    {
        $this->setType("FixedImage");
    }

    public function setType($type)
    {
        if ($type != "FixedImage") {
            throw new \InvalidArgumentException("Attempting to set type of FixedImage to $type.");
        }
        parent::setType($type);
    }

    public function getResourceUriChoiceList()
    {
        return $this->_resourceUriChoiceList;
    }

    public function getResourceUri()
    {
        return $this->_resourceUri;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    public function getImageBox()
    {
        return $this->_imageBox;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $imageBox
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setImageBox($imageBox)
    {
        $this->_imageBox = $imageBox;
    }

    /**
     * @param string $resourceUri
     * @XmlElement(type="string")
     */
    public function setResourceUri($resourceUri)
    {
        $this->_resourceUri = $resourceUri;
    }

    /**
     * @param string[] $resourceUriChoiceList
     * @XmlElementWrapper
     * @XmlElement(type="string[]", name="ResourceUri")
     */
    public function setResourceUriChoiceList($resourceUriChoiceList)
    {
        $this->_resourceUriChoiceList = $resourceUriChoiceList;
    }

}
