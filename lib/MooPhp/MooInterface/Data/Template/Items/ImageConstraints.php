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

class ImageConstraints
{

    /**
     * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    protected $_leftEdge;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    protected $_rightEdge;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    protected $_topEdge;

    /**
     * @var \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    protected $_bottomEdge;


    /**
     * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    public function getBottomEdge()
    {
        return $this->_bottomEdge;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    public function getLeftEdge()
    {
        return $this->_leftEdge;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    public function getRightEdge()
    {
        return $this->_rightEdge;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint
     */
    public function getTopEdge()
    {
        return $this->_topEdge;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $bottomEdge
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint")
     */
    public function setBottomEdge($bottomEdge)
    {
        $this->_bottomEdge = $bottomEdge;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $leftEdge
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint")
     */
    public function setLeftEdge($leftEdge)
    {
        $this->_leftEdge = $leftEdge;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $rightEdge
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint")
     */
    public function setRightEdge($rightEdge)
    {
        $this->_rightEdge = $rightEdge;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint $topEdge
     * @XmlElement(type="\MooPhp\MooInterface\Data\Template\Items\ImageEdgeConstraint")
     */
    public function setTopEdge($topEdge)
    {
        $this->_topEdge = $topEdge;
    }


}
