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

class RenderSideUrl extends CommonRenderSide
{
    public function __construct()
    {
        parent::__construct("moo.pack.renderSideUrl", self::HTTP_POST);
    }


}
