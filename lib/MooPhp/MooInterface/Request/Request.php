<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

abstract class Request
{

    protected $_method;

    public function __construct($method = null)
    {
        $this->_method = $method;
    }

    /**
     * @return string Get the method
     */
    public function getMethod()
    {
        return $this->_method;
    }

    public function setMethod($method)
    {
        $this->_method = $method;
    }

}
