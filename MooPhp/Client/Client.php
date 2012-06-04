<?php
namespace MooPhp\Client;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

interface Client
{

    /**
     * @param string $method
     * @param array $params
     * @return string
     */
    public function makeRequest($method, array $params);

    /**
     * @abstract
     * @param string $method
     * @param array $params
     * @param string $fileParam The name of the param that contains the path to the file on disk
     * @return string
     */
    public function sendFile($method, array $params, $fileParam);

    public function getFile($method, array $params);

    /**
     * @abstract
     * @return \Weasel\Logger\Logger
     */
    public function getLogger();

}
