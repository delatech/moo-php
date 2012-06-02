<?php
namespace MooPhp\Client;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

interface Client {

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
	 * @param string $file Path to the file on disk to transfer
	 * @return string
	 */
	public function sendFile($method, array $params, $file);

	public function getFile($method, array $params);

    /**
     * @abstract
     * @return \Weasel\Logger\Logger
     */
    public function getLogger();

}
