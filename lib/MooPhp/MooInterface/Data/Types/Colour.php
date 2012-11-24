<?php
namespace MooPhp\MooInterface\Data\Types;
use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonTypeInfo;
use Weasel\JsonMarshaller\Config\Annotations\JsonSubTypes;
use Weasel\XmlMarshaller\Config\Annotations\XmlElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\Annotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\Annotations\XmlSeeAlso;
use Weasel\XmlMarshaller\Config\Annotations\XmlDiscriminator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonTypeInfo(use=JsonTypeInfo.Id.NAME, as=JsonTypeInfo.As.PROPERTY, property="type")
 * @JsonSubTypes({@JsonSubTypes\Type("\MooPhp\MooInterface\Data\Types\ColourCMYK"), @JsonSubTypes\Type("\MooPhp\MooInterface\Data\Types\ColourRGB")})
 *
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 * @XmlSeeAlso({"\MooPhp\MooInterface\Data\Types\ColourCMYK", "\MooPhp\MooInterface\Data\Types\ColourRGB"})
 * @XmlDiscriminator("@type")
 *
 */
class Colour
{

    const COLOUR_RGB = "RGB";
    const COLOUR_CMYK = "CMYK";

    protected $_type;

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param string $type
     * @return \MooPhp\MooInterface\Data\Types\Colour
     * @JsonProperty(type="string")
     */
    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }
}
