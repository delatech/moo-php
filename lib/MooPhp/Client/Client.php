<?php
namespace MooPhp\Client;

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

interface Client
{

    const HTTP_POST = "POST";
    const HTTP_GET = "GET";

    /**
     * @param array $params
     * @param string $method HTTP method to use (one of the HTTP_ consts)
     * @return string
     */
    public function makeRequest(array $params, $method = self::HTTP_POST);

    /**
     * @abstract
     * @param array $params
     * @param string $fileParam The name of the param that contains the path to the file on disk
     * @return string
     */
    public function sendFile(array $params, $fileParam);

    /**
     * @abstract
     * @param array $paramss Array of arrays of parameters.
     * @param string $fileParam The name of the param that contains the path to the file on disk
     * @return string[] Array of response bodies.
     */
    public function sendFiles(array $paramss, $fileParam);

    /**
     * @abstract
     * @param array $params
     * @return string
     */
    public function getFile(array $params);

}
