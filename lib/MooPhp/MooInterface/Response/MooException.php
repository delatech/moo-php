<?php
namespace MooPhp\MooInterface\Response;

use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;
use Weasel\JsonMarshaller\Config\Annotations\JsonCreator;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

class MooException extends \Exception
{

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
