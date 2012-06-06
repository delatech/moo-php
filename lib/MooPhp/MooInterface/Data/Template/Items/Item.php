<?php
namespace MooPhp\MooInterface\Data\Template\Items;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlSeeAlso;
use Weasel\XmlMarshaller\Config\Annotations\XmlDiscriminator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 * @XmlSeeAlso({"\MooPhp\MooInterface\Data\Template\Items\BoxItem",
"\MooPhp\MooInterface\Data\Template\Items\FixedImageItem",
"\MooPhp\MooInterface\Data\Template\Items\ImageItem",
"\MooPhp\MooInterface\Data\Template\Items\MultiLineTextItem",
"\MooPhp\MooInterface\Data\Template\Items\TextItem"})
 */

class Item
{

    /**
     * @var string
     */
    protected $_linkId;

    /**
     * @var string
     */
    protected $_type = null;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Layout
     */
    protected $_layout;

    /**
     * Compare this Item's zindex to another item's zindex.
     * Returns 0 if equal.
     * Returns -1 if this item has a lower zIndex
     * Returns 1 if this item has a higher zIndex
     * @param Item $b
     * @return int
     */
    public function compareZIndexTo(Item $b)
    {
        if ($this->getLayout()->getZIndex() == $b->getLayout()->getZIndex()) {
            return 0;
        }
        return ($this->getLayout()->getZIndex() < $b->getLayout()->getZIndex()) ? -1 : 1;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return string
     */
    public function getLinkId()
    {
        return $this->_linkId;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Layout
     */
    public function getLayout()
    {
        return $this->_layout;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @param string $linkId
     * @XmlElement(type="string")
     */
    public function setLinkId($linkId)
    {
        $this->_linkId = $linkId;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Layout $layout
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Layout")
     */
    public function setLayout($layout)
    {
        $this->_layout = $layout;
    }
}
