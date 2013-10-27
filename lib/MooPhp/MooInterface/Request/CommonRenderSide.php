<?php
namespace MooPhp\MooInterface\Request;
use MooPhp\Api;
use MooPhp\MooInterface\Data\ImageBasket;
use MooPhp\MooInterface\Data\Side;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class CommonRenderSide extends Request
{

    /**
     * @var Side
     */
    private $_side;

    /**
     * @var ImageBasket
     */
    private $_imageBasket;

    /**
     * @var string
     */
    private $_boxType = Api::BOX_PRINT;

    /**
     * @var int
     */
    private $_maxSide = 1500;

    /**
     * @var Side[]
     */
    private $_overlays = null;

    /**
     * @param string $boxType
     */
    public function setBoxType($boxType)
    {
        $this->_boxType = $boxType;
    }

    /**
     * @return string
     */
    public function getBoxType()
    {
        return $this->_boxType;
    }

    /**
     * @param \MooPhp\MooInterface\Data\ImageBasket $imageBasket
     */
    public function setImageBasket($imageBasket)
    {
        $this->_imageBasket = $imageBasket;
    }

    /**
     * @return \MooPhp\MooInterface\Data\ImageBasket
     */
    public function getImageBasket()
    {
        return $this->_imageBasket;
    }

    /**
     * @param int $maxSide
     */
    public function setMaxSide($maxSide)
    {
        $this->_maxSide = $maxSide;
    }

    /**
     * @return int
     */
    public function getMaxSide()
    {
        return $this->_maxSide;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Side[] $overlays
     */
    public function setOverlays($overlays)
    {
        $this->_overlays = $overlays;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Side[]
     */
    public function getOverlays()
    {
        return $this->_overlays;
    }

    /**
     * @param \MooPhp\MooInterface\Data\Side $side
     */
    public function setSide($side)
    {
        $this->_side = $side;
    }

    /**
     * @return \MooPhp\MooInterface\Data\Side
     */
    public function getSide()
    {
        return $this->_side;
    }


}
