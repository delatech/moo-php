<?php
namespace MooPhp\Client;
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class OAuthSigningClient implements Client {

	protected $_apiKey;
	protected $_apiSecret;

	protected $_token;
	protected $_tokenSecret;

	protected $_oauth;

	protected $_ch;

	/**
	 * @var \Weasel\Logger\Logger
	 */
	protected $_logger;

	protected $_marshaller;

	protected $_urls = array(
		'requestToken' => 'https://secure.moo.com/oauth/request_token.php',
		'authorize' => 'https://secure.moo.com/oauth/authorize.php',
		'accessToken' => 'https://secure.moo.com/oauth/access_token.php',
		'apiEndpoint' => 'https://secure.moo.com/api/service/'
	);


	public function __construct($apiKey, $apiSecret, $logger = null) {
		$this->_apiKey = $apiKey;
		$this->_apiSecret = $apiSecret;
		$this->_oauth = new \OAuth($apiKey,$apiSecret,OAUTH_SIG_METHOD_HMACSHA1,OAUTH_AUTH_TYPE_AUTHORIZATION);
		$this->_oauth->disableSSLChecks(); // Err, why?

		$this->_logger = $logger;

		$this->_ch = curl_init();
		curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
	}

	public function getAuthUrl($callback = "oob") {
		return $this->_urls["authorize"] . "?oauth_token=" . urlencode($this->_token) . "&oauth_callback=" . urlencode($callback);
	}

	public function setToken($token, $secret) {
		$this->_token = $token;
		$this->_tokenSecret = $secret;
		$this->_oauth->setToken($token, $secret);
		return $this->getToken();
	}

	public function getToken() {
		return array("token" => $this->_token, "secret" => $this->_tokenSecret);
	}

	public function getRequestToken() {
		$token = $this->_oauth->getRequestToken($this->_urls['requestToken']);
		return $this->setToken($token['oauth_token'], $token['oauth_token_secret']);
	}

	public function getAccessToken() {
		$token = $this->_oauth->getAccessToken($this->_urls['accessToken']);
		return $this->setToken($token['oauth_token'], $token['oauth_token_secret']);
	}

	/**
	 * @param string $method
	 * @param array $params
	 * @return string
	 */
	public function makeRequest($method, array $params) {

		$target = $this->_urls["apiEndpoint"];
		$params = array("method" => $method, "errorsAsOK" => "false") + $params;

		if ($this->_logger) $this->_logger->logDebug("Request: " . print_r($params, true));
		$this->_oauth->fetch($target, $params, OAUTH_HTTP_METHOD_POST, array());

		$rawResponse = $this->_oauth->getLastResponse();
		if ($this->_logger) $this->_logger->logDebug("Response: " . $rawResponse);

		return $rawResponse;
	}

    /**
     * @param string $method
     * @param array $params
     * @param string $file Path to the file on disk to transfer
     * @throws \RuntimeException
     * @return mixed
     */
	public function sendFile($method, array $params, $file) {
		$ch = $this->_ch;
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $this->_urls["apiEndpoint"]);

		$params = array("imageFile" => "@".$file, "method" => $method, "errorsAsOK" => "false") + $params;

		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

		if ($this->_logger) $this->_logger->logDebug("Request: " . print_r($params, true));
		$rawResponse = curl_exec($ch);
		if ($this->_logger) $this->_logger->logDebug("Response: " . $rawResponse);

		$errno = curl_errno($ch);
		if (!$rawResponse || $errno != CURLE_OK) {
			throw new \RuntimeException("Error sending file: ($errno) " . curl_error($ch));
		}

		return $rawResponse;
	}

	public function getFile($method, array $params) {
		$ch = $this->_ch;
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$params = array("method" => $method, "errorsAsOK" => "false") + $params;
		$url = $this->_urls["apiEndpoint"] . '?' . http_build_query($params);

		curl_setopt($ch, CURLOPT_URL, $url);
		if ($this->_logger) $this->_logger->logDebug("Request: " . print_r($params, true));
		$rawResponse = curl_exec($ch);
		if ($this->_logger) $this->_logger->logDebug("Response: " . $rawResponse);

		$errno = curl_errno($ch);
		if (!$rawResponse || $errno != CURLE_OK) {
			throw new \RuntimeException("Error retrieving file: ($errno) " . curl_error($ch));
		}

		return $rawResponse;

	}

    public function getLogger()
    {
        return $this->_logger;
    }
}
