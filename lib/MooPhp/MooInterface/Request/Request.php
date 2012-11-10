<?php
namespace MooPhp\MooInterface\Request;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

abstract class Request
{
    const HTTP_POST = "POST";
    const HTTP_GET = "GET";

    protected $_httpMethod = self::HTTP_POST;
    protected $_method;

    public function __construct($method = null, $httpMethod = self::HTTP_POST)
    {
        $this->_method = $method;
        $this->_httpMethod = $httpMethod;
    }

    public function setHttpMethod($httpMethod)
    {
        $this->_httpMethod = $httpMethod;
        return $this;
    }

    public function getHttpMethod()
    {
        return $this->_httpMethod;
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
