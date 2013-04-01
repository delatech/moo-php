<?php
namespace MooPhp\MooInterface\Data\Types;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonProperty;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonTypeInfo;
use Weasel\JsonMarshaller\Config\DoctrineAnnotations\JsonSubTypes;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlElement;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlAttribute;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlRootElement;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlSeeAlso;
use Weasel\XmlMarshaller\Config\DoctrineAnnotations\XmlDiscriminator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 *
 * @JsonTypeInfo(use=JsonTypeInfo::ID_NAME, include=JsonTypeInfo::AS_PROPERTY, property="type")
 * @JsonSubTypes({@JsonSubTypes\Type("\MooPhp\MooInterface\Data\Types\ColourCMYK"), @JsonSubTypes\Type("\MooPhp\MooInterface\Data\Types\ColourRGB")})
 *
 * @XmlRootElement(namespace="http://www.moo.com/xsd/template-1.0")
 * @XmlSeeAlso({"\MooPhp\MooInterface\Data\Types\ColourCMYK", "\MooPhp\MooInterface\Data\Types\ColourRGB"})
 * @XmlDiscriminator("@type")
 *
 */
class Colour
{

}
