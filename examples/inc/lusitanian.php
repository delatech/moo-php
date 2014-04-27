<?php
function getClient($key, $secret)
{
    return new \MooPhp\Client\Lusitanian\LusitanianDirectOauthClient($key, $secret);
}
