<?php
namespace MooPhp\MooInterface\Data\Types;
use PhpJsonMarshaller\Config\Annotations\JsonProperty;
use PhpJsonMarshaller\Config\Annotations\JsonTypeInfo;
use PhpJsonMarshaller\Config\Annotations\JsonSubTypes;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 *
 * @JsonTypeInfo(use=JsonTypeInfo.Id.NAME, as=JsonTypeInfo.As.PROPERTY, property="type")
 * @JsonSubTypes({@JsonSubTypes\Type("\MooPhp\MooInterface\Data\Types\ColourCMYK"), @JsonSubTypes\Type("\MooPhp\MooInterface\Data\Types\ColourRGB")})
 */
class Colour {

	const COLOUR_RGB = "RGB";
	const COLOUR_CMYK = "CMYK";

	protected $_type;

    /**
     * @return string
     * @JsonProperty(type="string")
     */
    public function getType() {
		return $this->_type;
	}

    /**
     * @param string $type
     * @JsonProperty(type="string")
     */
    public function setType($type) {
		$this->_type = $type;
	}
}
