<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Extra
{

    /**
     * @var string
     */
    protected $_key;

    /**
     * @var string
     */
    protected $_value;

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @param string $key
     * @return \MooPhp\MooInterface\Data\Extra
     * @JsonProperty(type="string")
     */
    public function setKey($key)
    {
        $this->_key = $key;
        return $this;
    }

    /**
     * @param string $value
     * @return \MooPhp\MooInterface\Data\Extra
     * @JsonProperty(type="string")
     */
    public function setValue($value)
    {
        $this->_value = $value;
        return $this;
    }

}
