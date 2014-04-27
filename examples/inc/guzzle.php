<?php

function getClient($key, $secret)
{
    $guzzle = new \Guzzle\Http\Client();
    $guzzle->addSubscriber(new Guzzle\Plugin\Oauth\OauthPlugin(
        array(
            "consumer_key" => $key,
            "consumer_secret" => $secret
        )
    ));
    // If you want 3 legged oauth, you're going to have to faff with the OauthPlugin for a bit.
    // I am not providing an example. Sorry.

    return new \MooPhp\Client\GuzzleClient($guzzle);
}

