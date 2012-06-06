<?php
namespace MooPhp\MooInterface\Data\UserData;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonTypeInfo;
use Weasel\JsonMarshaller\Config\Annotations\JsonSubTypes;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonTypeInfo(use=JsonTypeInfo.Id.NAME, as=JsonTypeInfo.As.PROPERTY, property="type")
 * @JsonSubTypes({@JsonSubTypes\Type("\MooPhp\MooInterface\Data\UserData\BoxData"),
@JsonSubTypes\Type("\MooPhp\MooInterface\Data\UserData\ImageData"),
@JsonSubTypes\Type("\MooPhp\MooInterface\Data\UserData\MultiLineTextData"),
@JsonSubTypes\Type("\MooPhp\MooInterface\Data\UserData\TextData"),
})
 */

class Datum
{

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getLinkId()
    {
        return $this->_linkId;
    }

    /**
     * @param string $linkId
     * @JsonProperty(type="string")
     */
    public function setLinkId($linkId)
    {
        $this->_linkId = $linkId;
    }

    /**
     * @param string $type
     * @JsonProperty(type="string")
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @var string
     */
    protected $_type;

    /**
     * @var string
     */
    protected $_linkId;

}
