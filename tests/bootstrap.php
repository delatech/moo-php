<?php

ini_set("display_errors", true);
error_reporting(E_ALL);
$loader = require_once(__DIR__ . "/../vendor/autoload.php");
$localWeasel = getenv("USE_LOCAL_WEASEL");
if ($localWeasel) {
    $loader->add('Weasel', $localWeasel, true);
}

