<?php
namespace MooPhp\MooInterface\Data\Template;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 */

class Settings
{

    /**
     * @var \MooPhp\MooInterface\Data\Template\Units
     */
    protected $_units;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Origin
     */
    protected $_origin;

    /**
     * @var \MooPhp\MooInterface\Data\Template\PrintArea
     */
    protected $_printArea;

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_bleedBox;

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_cutBox;

    /**
     * @var \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    protected $_safeAreaBox;

    /**
     * @var float
     */
    protected $_rotationAngle;

    /**
     * @var string
     */
    protected $_fontSubstitutionStrategy;

    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    public function getBleedBox()
    {
        return $this->_bleedBox;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    public function getCutBox()
    {
        return $this->_cutBox;
    }

    /**
     * @return string
     */
    public function getFontSubstitutionStrategy()
    {
        return $this->_fontSubstitutionStrategy;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Origin
     */
    public function getOrigin()
    {
        return $this->_origin;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\PrintArea
     */
    public function getPrintArea()
    {
        return $this->_printArea;
    }

    /**
     * @return float
     */
    public function getRotationAngle()
    {
        return $this->_rotationAngle;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Types\BoundingBox
     */
    public function getSafeAreaBox()
    {
        return $this->_safeAreaBox;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Units
     */
    public function getUnits()
    {
        return $this->_units;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $bleedBox
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setBleedBox($bleedBox)
    {
        $this->_bleedBox = $bleedBox;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $cutBox
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setCutBox($cutBox)
    {
        $this->_cutBox = $cutBox;
    }

    /**
     * @param string $fontSubstitutionStrategy
     * @XmlElement(type="string")
     */
    public function setFontSubstitutionStrategy($fontSubstitutionStrategy)
    {
        $this->_fontSubstitutionStrategy = $fontSubstitutionStrategy;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Origin $origin
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Origin")
     */
    public function setOrigin($origin)
    {
        $this->_origin = $origin;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\PrintArea $printArea
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\PrintArea")
     */
    public function setPrintArea($printArea)
    {
        $this->_printArea = $printArea;
    }

    /**
     * @param float $rotationAngle
     * @XmlElement(type="float")
     */
    public function setRotationAngle($rotationAngle)
    {
        $this->_rotationAngle = $rotationAngle;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Types\BoundingBox $safeAreaBox
     * @XmlElement(type="\MooPhp\MooInterface\Data\Types\BoundingBox")
     */
    public function setSafeAreaBox($safeAreaBox)
    {
        $this->_safeAreaBox = $safeAreaBox;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Units $units
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Units")
     */
    public function setUnits($units)
    {
        $this->_units = $units;
    }

}
