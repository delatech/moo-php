<?php

require_once(__DIR__ . '/../MooPhp/autoloader.php');
require_once(__DIR__ . '/lib/OldArrayConfigAdaptor.php');


$curArg = null;
$args = array();
$leftovers = array();
array_shift($argv);
foreach ($argv as $arg) {
	if (isset($curArg)) {
		$args[$curArg] = $arg;
		$curArg = null;
		continue;
	}
	if ($arg == "-o") {
		$curArg = "o";
		continue;
	}
	$leftovers[] = $arg;
}

$files = array();
foreach ($leftovers as $potentialFiles) {
	$config = realpath($potentialFiles);
	if (!is_file($config) || !is_readable($config)) {
		print "Cannot work on $potentialFiles as input\n";
		exit(1);
	}
	$files[] = $config;
}

if (isset($args["o"])) {
	$outFile = $args["o"];
} else {
	$outFile = "php://stdout";
}

function merge_configs(array $giantConfigArray, array $newConfigArray) {
	$newArray = array();

	foreach ($giantConfigArray as $key => $value) {
		if (is_array($value) && isset($newConfigArray[$key])) {
			$newArray[$key] = merge_configs($value, $newConfigArray[$key]);
		} else {
			$newArray[$key] = $value;
		}
	}
	$diff = array_diff(array_keys($newConfigArray), array_keys($giantConfigArray));
	foreach ($diff as $key) {
		$newArray[$key] = $newConfigArray[$key];
	}
	return $newArray;
}


$giantConfigArray = array();
foreach ($files as $config) {
	$oldArray = json_decode(file_get_contents($config), JSON_FORCE_OBJECT);

	$recoder = new OldArrayConfigAdaptor();

	$objects = $recoder->convertToNewObjects($oldArray);

	$mConfig = new \MooPhp\Serialization\ArrayConfigBaseConfig();
	$marshaller = new \MooPhp\Serialization\ArrayMarshaller($mConfig->getConfig());

	$newConfigArray = $marshaller->marshall($objects, "Root");

	$giantConfigArray = merge_configs($giantConfigArray, $newConfigArray);

}

$json = json_encode($giantConfigArray, true);

file_put_contents($outFile, $json);