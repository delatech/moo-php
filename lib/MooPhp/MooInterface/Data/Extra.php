<?php
namespace MooPhp\MooInterface\Data;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonProperty;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonCreator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class Extra
{

    /**
     * @param string $key
     * @param string $value
     * @JsonCreator({@JsonProperty(name="key", type="string"), @JsonProperty(name="value", type="string")})
     */
    public function __construct($key, $value)
    {
        $this->_key = $key;
        $this->_value = $value;
    }

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

}
