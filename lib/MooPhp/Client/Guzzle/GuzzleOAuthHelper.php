<?php


namespace MooPhp\Client\Guzzle;

use Guzzle\Http\Client as GuzzleHttpClient;

class GuzzleOAuthHelper
{

    /**
     * @var GuzzleHttpClient
     */
    protected $guzzleClient;

    protected $_urls = array(
        'requestToken' => 'https://secure.moo.com/oauth/request_token.php',
        'authorize' => 'https://secure.moo.com/oauth/authorize.php',
        'accessToken' => 'https://secure.moo.com/oauth/access_token.php',
    );

    function __construct($guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function getAuthUrl($token, $callback = "oob")
    {
        return $this->_urls["authorize"] . "?oauth_token=" . urlencode($token) . "&oauth_callback=" . urlencode($callback);
    }

    protected function getToken($url)
    {
        $tokenRequest = $this->guzzleClient->get($url);
        $response = $this->guzzleClient->send($tokenRequest);
        if (!$response->isSuccessful()) {
            throw new \Exception("Failed to get token from $url");
        }
        $tokenData = array();
        parse_str($response->getBody(true), $tokenData);

        return array(
            "token" => $tokenData["oauth_token"],
            "token_secret" => $tokenData["oauth_token_secret"],
        );
    }

    public function getRequestToken()
    {
        return $this->getToken($this->_urls['requestToken']);
    }

    public function getAccessToken()
    {
        return $this->getToken($this->_urls['accessToken']);
    }

} 