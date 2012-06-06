<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Warning
{

    private $_element;
    private $_code;
    private $_message;

    /**
     * @return string
     */
    public function getElement()
    {
        return $this->_element;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param $code
     * @JsonProperty(type="string")
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }

    /**
     * @param $element
     * @JsonProperty(type="string")
     */
    public function setElement($element)
    {
        $this->_element = $element;
    }

    /**
     * @param $message
     * @JsonProperty(type="string")
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }
}
