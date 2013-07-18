<?php
namespace MooPhp\MooInterface\Data\Template;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlElement;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class PrintArea
{

    /**
     * @var float
     */
    protected $_height;

    /**
     * @var float
     */
    protected $_width;

    /**
     * @var float
     */
    protected $_cornerRadius;

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->_height;
    }

    /**
     * @return float
     */
    public function getWidth()
    {
        return $this->_width;
    }

    /**
     * @return float
     */
    public function getCornerRadius()
    {
        return $this->_cornerRadius;
    }

    /**
     * @param float $height
     * @XmlElement(type="float")
     */
    public function setHeight($height)
    {
        $this->_height = $height;
    }

    /**
     * @param float $width
     * @XmlElement(type="float")
     */
    public function setWidth($width)
    {
        $this->_width = $width;
    }

    /**
     * @param float $cornerRadius
     * @XmlElement(type="float")
     */
    public function setCornerRadius($cornerRadius)
    {
        $this->_cornerRadius = $cornerRadius;
    }
}
