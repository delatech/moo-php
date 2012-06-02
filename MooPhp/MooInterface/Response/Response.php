<?php
namespace MooPhp\MooInterface\Response;

use Weasel\JsonMarshaller\Config\Annotations\JsonProperty;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

abstract class Response {

    /**
     * @var \MooPhp\MooInterface\Response\MooException
     */
    protected $exception;


    /**
     * @param \MooPhp\MooInterface\Response\MooException $exception
     * @JsonProperty(type="\MooPhp\MooInterface\Response\MooException")
     */
    public function setException($exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return \MooPhp\MooInterface\Response\MooException
     */
    public function getException()
    {
        return $this->exception;
    }
}
