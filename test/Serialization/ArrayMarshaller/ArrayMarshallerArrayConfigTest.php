<?php
namespace ArrayMarshallerTests\Marshalling;

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
							array(
								"type" => "array",
								"options" => array(
									"name" => "geets"
								)
							)
						),
						"type" => array( "type" => "string" )
					),
					"stoats" => array(
						"type" => array( "type" => "int" )
					),
					"boats" => array(
						"type" => array ("type" => "float" )
					),
					"groats" => array(
						"options" => array(
							array(
								"type" => "array",
								"options" => array(
									"name" => "goats"
								)
							)
						),
						"type" => array ("type" => "bool")
					),
				)
			)
		));

		$configurator = new \MooPhp\Serialization\ArrayConfigBaseConfig();
		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($configurator->getConfig());

		$unmarshalled = $marshaller->unmarshall($config, "Root");

	}
}
