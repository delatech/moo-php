<?php
namespace MooPhp\MooInterface\Response;

use PhpMarshaller\Config\Annotations\JsonProperty;
use PhpMarshaller\Config\Annotations\JsonCreator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class MooException extends \Exception {

    /**
     * @param string $message
     * @param int $code
     * @JsonCreator({@JsonProperty(name="message", type="string"), @JsonProperty(name="code", type="integer")})
     */
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message ? : "", $code ? : 0);
    }


}
