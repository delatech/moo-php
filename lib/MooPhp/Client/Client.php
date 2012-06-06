<?php
namespace MooPhp\Client;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan@moo.com>
 * @copyright Copyright (c) 2012, Moo Print Ltd.
 */

interface Client
{

    /**
     * @param array $params
     * @return string
     */
    public function makeRequest(array $params);

    /**
     * @abstract
     * @param array $params
     * @param string $fileParam The name of the param that contains the path to the file on disk
     * @return string
     */
    public function sendFile(array $params, $fileParam);

    /**
     * @abstract
     * @param array $params
     * @return string
     */
    public function getFile(array $params);

    /**
     * @abstract
     * @return \Weasel\Logger\Logger
     */
    public function getLogger();

}
