<?php
namespace ArrayMarshallerTests\Marshalling;

use MooPhp\Serialization\Config as Config;

require_once(__DIR__ . "/../../TestInit.php");

/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */

class ArrayMarshallerArrayConfigTest extends \PHPUnit_Framework_TestCase {
	public function testUnmarshallSimpleConfig() {

		$config = array("config" => array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyClassA',
				"properties" => array(
					"goats" => array(
						"options" => array(
							"array" => array(
								"options" => array(
									"name" => "geets"
								)
							)
						),
						"type" => "string"
					),
					"stoats" => array(
						"type" => "int"
					),
					"boats" => array(
						"type" => "float",
					),
					"groats" => array(
						"options" => array(
							"array" => array(
								"options" => array(
									"name" => "goats"
								)
							)
						),
						"type" => "bool"
					),
				)
			)
		));

		$configurator = new \MooPhp\Serialization\ArrayConfigBaseConfig();
		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($configurator->getConfig());

		$unmarshalled = $marshaller->unmarshall($config, "Root");

		$classAConfig = new Config\ConfigElement();
		$classAConfig->setType(__NAMESPACE__ . '\DummyClassA');

		$goats = new Config\Types\StringType();
		$goatsOption = new Config\SerializerSpecificOptions();
		$goatsOption->setOption("name", "geets");
		$goats->setOption("array", $goatsOption);
		$classAConfig->setProperty("goats", $goats);

		$classAConfig->setProperty('stoats', new Config\Types\IntType());
		$classAConfig->setProperty('boats', new Config\Types\FloatType());

		$groats = new Config\Types\BoolType();
		$groatsOption = new Config\SerializerSpecificOptions();
		$groatsOption->setOption("name", "goats");
		$groats->setOption("array", $groatsOption);
		$classAConfig->setProperty("groats", $groats);

		$expected = new Config\MarshallerConfig();
		$expected->setConfigElement("DummyClassA", $classAConfig);

		$this->assertEquals(array($expected), array($unmarshalled));

	}
}
