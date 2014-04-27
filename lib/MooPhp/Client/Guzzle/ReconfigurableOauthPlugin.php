<?php
namespace MooPhp\Client\Guzzle;

use Guzzle\Plugin\Oauth\OauthPlugin;

/**
 * Extend the oauth plugin for guzzle so that we can change the token and secret after instantiation.
 * Class ReconfigurableOauthPlugin
 * @package MooPhp\Client\Guzzle
 */
class ReconfigurableOauthPlugin extends OauthPlugin
{

    public function setToken($token, $secret)
    {
        $this->config["token"] = $token;
        $this->config["token_secret"] = $secret;
    }

    public function setTokenData($tokenData)
    {
        $this->setToken($tokenData["token"], $tokenData["token_secret"]);
    }

} 