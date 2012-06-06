<?php
namespace MooPhp\MooInterface\Data\Template;

use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlElementWrapper;
use Weasel\XmlMarshaller\Config\Annotations\XmlElementRef;
use Weasel\XmlMarshaller\Config\Annotations\XmlElementRefs;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */
class Template
{

    /**
     * @var string
     */
    protected $_templateCode;

    /**
     * @var string
     */
    protected $_templateVersion;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Settings
     */
    protected $_settings;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Items\Item
     */
    private $_itemsByLinkIdInZIndexOrder = array();

    public function getItemByLinkId($linkId)
    {
        if (isset($this->_itemsByLinkIdInZIndexOrder[$linkId])) {
            return $this->_itemsByLinkIdInZIndexOrder[$linkId];
        }
        return null;
    }

    /**
     * @return string
     */
    public function getTemplateVersion()
    {
        return $this->_templateVersion;
    }

    /**
     * @return string
     */
    public function getTemplateCode()
    {
        return $this->_templateCode;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Settings
     */
    public function getSettings()
    {
        return $this->_settings;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Items\Item[]
     */
    public function getItems()
    {
        return $this->_itemsByLinkIdInZIndexOrder;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Items\Item[] $items
     * @XmlElementWrapper
     * @XmlElementRefs(type="\MooPhp\MooInterface\Data\Template\Items\Item", values={
    @XmlElementRef(name="Box", type="\MooPhp\MooInterface\Data\Template\Items\BoxItem"),
    @XmlElementRef(name="FixedImage", type="\MooPhp\MooInterface\Data\Template\Items\FixedImageItem"),
    @XmlElementRef(name="Image", type="\MooPhp\MooInterface\Data\Template\Items\ImageItem"),
    @XmlElementRef(name="MultiLineText", type="\MooPhp\MooInterface\Data\Template\Items\MultiLineTextItem"),
    @XmlElementRef(name="Text", type="\MooPhp\MooInterface\Data\Template\Items\TextItem")})
     */
    public function setItems($items)
    {
        foreach ($items as $item) {
            $this->_itemsByLinkIdInZIndexOrder[$item->getLinkId()] = $item;
        }
        uasort($this->_itemsByLinkIdInZIndexOrder,
            function(\MooPhp\MooInterface\Data\Template\Items\Item $a, \MooPhp\MooInterface\Data\Template\Items\Item $b)
            {
                return $a->compareZIndexTo($b);
            }
        );
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Settings $settings
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Settings")
     */
    public function setSettings($settings)
    {
        $this->_settings = $settings;
    }

    /**
     * @param string $templateCode
     * @XmlElement(name="Code", type="string")
     */
    public function setTemplateCode($templateCode)
    {
        $this->_templateCode = $templateCode;
    }

    /**
     * @param string $templateVersion
     * @XmlElement(name="Version", type="string")
     */
    public function setTemplateVersion($templateVersion)
    {
        $this->_templateVersion = $templateVersion;
    }

}
