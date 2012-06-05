<?php
namespace MooPhp\MooInterface\Response;
use Weasel\JsonMarshaller\Config\Annotations\JsonIgnoreProperties;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 *
 * @JsonIgnoreProperties(names={"warnings", "uploadImageError"})
 */
class UploadImage extends CommonImage
{
}

