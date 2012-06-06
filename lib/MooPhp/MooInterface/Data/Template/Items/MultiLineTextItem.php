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

class MultiLineTextItem extends TextItem
{

    /**
     * @var float
     */
    protected $_baselineOffset;

    /**
     * @var float
     */
    protected $_leading;

    /**
     * @var string
     */
    protected $_verticalAlignment;

    public function __construct()
    {
        $this->setType("MultiLineText");
    }

    public function setType($type)
    {
        if ($type != "MultiLineText") {
            throw new \InvalidArgumentException("Attempting to set type of MultiLineText to $type.");
        }
        parent::setType($type);
    }

    /**
     * @return float
     */
    public function getBaselineOffset()
    {
        return $this->_baselineOffset;
    }

    /**
     * @return float
     */
    public function getLeading()
    {
        return $this->_leading;
    }

    /**
     * @return string
     */
    public function getVerticalAlignment()
    {
        return $this->_verticalAlignment;
    }

    /**
     * @param float $baselineOffset
     * @XmlElement(type="float")
     */
    public function setBaselineOffset($baselineOffset)
    {
        $this->_baselineOffset = $baselineOffset;
    }

    /**
     * @param float $leading
     * @XmlElement(type="float")
     */
    public function setLeading($leading)
    {
        $this->_leading = $leading;
    }

    /**
     * @param string $verticalAlignment
     * @XmlElement(type="string")
     */
    public function setVerticalAlignment($verticalAlignment)
    {
        $this->_verticalAlignment = $verticalAlignment;
    }

}
