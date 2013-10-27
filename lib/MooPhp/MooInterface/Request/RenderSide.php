<?php
namespace MooPhp\MooInterface\Request;
use MooPhp\Api;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class RenderSide extends CommonRenderSide
{

    public function __construct()
    {
        parent::__construct("moo.pack.renderSide", self::HTTP_POST);
    }

}
