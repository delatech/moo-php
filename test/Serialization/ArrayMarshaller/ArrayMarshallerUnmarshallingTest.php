<?php
/**
 * These test cases handle the unmarshalling part of the ArrayMarshaller.
 * They're a bit funky... They rely on the Marshaller instantiating a bunch of
 * dummy classes, which have magic __call methods which invoke methods on static PHPUnit Mock objects.
 * It's a bit convoluted but it works...
 *
 * However... we cannot test that the instance of a nested object that gets passed into a setter is really
 * the one we expect it to be.
 * There's also a test object that does not have a magic __call, so we can be reasonably sure this mechanism really
 * works on real world objects.
 *
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */
namespace ArrayMarshallerTests\Unmarshalling;

require_once(__DIR__ . "/../../TestInit.php");

class ArrayMarshallerUnmarshallingTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @param $config
	 * @return \MooPhp\Serialization\ArrayMarshaller
	 */
	protected function _getMarshaller($config) {
		$configurator = new \MooPhp\Serialization\ArrayConfigBaseConfig();
		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($configurator->getConfig());
		return new \MooPhp\Serialization\ArrayMarshaller($marshaller->unmarshall(array("config" => $config), "Root"));
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\Marshaller
	 * @expectedException \InvalidArgumentException
	 */
	public function testUnmarshalNonArray() {
		$config = array(

		);

		$marshaller = $this->_getMarshaller($config);
		$marshaller->unmarshall("hello", "Test");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @expectedException \RuntimeException
	 */
	public function testUnmarshalNoConfigElement() {
		$config = array(

		);

		$marshaller = $this->_getMarshaller($config);
		$marshaller->unmarshall(array("groat" => "bloat"), "Test");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @expectedException \RuntimeException
	 */
	public function testUnmarshallBadTypeConfig() {

		$config = array(
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
						"type" => "giraffe"
					)
				)
			)
		);

		$input = array("geets" => "baa");

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats'));
		DummyClassA::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$marshaller->unmarshall($input, "DummyClassA");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @expectedException \RuntimeException
	 */
	public function testUnmarshallNoObject() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\AmFailLots',
				"properties" => array(
					"goats" => array(
						"options" => array(
							"array" => array(
								"options" => array(
									"name" => "geets"
								)
							)
						),
						"type" => "giraffe"
					)
				)
			)
		);

		$input = array("geets" => "baa");

		$marshaller = $this->_getMarshaller($config);
		$marshaller->unmarshall($input, "DummyClassA");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @expectedException \RuntimeException
	 */
	public function testUnmarshallBadComplexTypeConfig() {

		$config = array(
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
						"type" => "giraffe",
					)
				)
			)
		);

		$input = array("geets" => array( "foo" => "bar" ));
		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats'));
		DummyClassA::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$marshaller->unmarshall($input, "DummyClassA");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 * @expectedException \RuntimeException
	 */
	public function testUnmarshallBadMethod() {

		$config = array(
			"DummyNoCall" => array(
				"type" => __NAMESPACE__ . '\DummyNoCall',
				"properties" => array(
					"noexisty" => array(
						"type" => "string"
					)
				)
			)
		);

		$input = array("noexisty" => "wheeeee");

		$mock = $this->getMock(__NAMESPACE__ . '\DummyNoCall', array());
		DummyNoCall::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$marshaller->unmarshall($input, "DummyNoCall");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallPrimitives() {

		$config = array(
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
						"type" => "float"
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
		);

		$input = array(
			"geets" => "baa",
			"stoats" => 1,
			"boats" => 5.1,
			"goats" => false
		);

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats', 'setStoats', 'setBoats', 'setGroats'));

		$mock->expects($this->once())->method('setGoats')->with($this->identicalTo("baa"));
		$mock->expects($this->once())->method('setStoats')->with($this->identicalTo(1));
		$mock->expects($this->once())->method('setBoats')->with($this->identicalTo(5.1));
		$mock->expects($this->once())->method('setGroats')->with($this->identicalTo(false));

		DummyClassA::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassA', $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallPrimativeArray() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyNoCall',
				"properties" => array(
					"goats" => array(
						"options" => array(
							"array" => array(
								"options" => array(
									"name" => "geets"
								)
							)
						),
						"type" => "array",
						"key" => array("type" => "int"),
						"value" => array("type" => "string")
					),
					"stoats" => array(
						"type" => "array",
						"key" => array("type" => "int"),
						"value" => array("type" => "int"),
					),
					"boats" => array(
						"type" => "array",
						"key" => array("type" => "string"),
						"value" => array("type" => "float")
					),
					"groats" => array(
						"options" => array(
							"array" => array(
								"options" => array(
									"name" => "goats"
								)
							)
						),
						"type" => "array",
						"key" => array("type" => "int"),
						"value" => array("type" => "bool")
					)
				)
			)
		);

		$mock = $this->getMock(__NAMESPACE__ . '\DummyNoCall', array('setGoats', 'setStoats', 'setBoats', 'setGroats'));

		$mock->expects($this->once())->method('setGoats')->with($this->identicalTo(array("baa", "bar", "fishpaste wobble")));
		$mock->expects($this->once())->method('setStoats')->with($this->identicalTo(array(9 => 1, 2 => 7, 378 => 9, 44 => 8)));
		$mock->expects($this->once())->method('setBoats')->with($this->identicalTo(array("arr" => 1.1, "pirates" => 6.1)));
		$mock->expects($this->once())->method('setGroats')->with($this->identicalTo(array(true, false, true, true, false)));

		DummyNoCall::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$input = array(
			"geets" => array(0 => "baa", 1 => "bar", 2 => "fishpaste wobble"),
			"stoats" => array(9 => 1, 2 => 7, 378 => 9, 44 => 8),
			"boats" => array("arr" => 1.1, "pirates" => 6.1),
			"goats" => array(0 => true, 1 => false, 2 => true, 3 => true, 4 => false),
		);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyNoCall', $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallNestedArray() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyClassA',
				"properties" => array(
					"goats" => array(
						"type" => "array",
						"key" => array( "type" => "int" ),
						"value" => array(
							"type" => "array",
							"key" => array( "type" => "string"),
							"value" => array("type" => "string")
						)
					),
					"stoats" => array(
						"type" => "array",
						"key" => array("type" => "string"),
						"value" => array(
							"type" => "array",
							"key" => array("type" => "string"),
							"value" => array(
								"type" => "array",
								"key" => array("type" => "int"),
								"value" => array("type" => "string")
							)
						)
					),
					"boats" => array(
						"type" => "string"
					),
					"groats" => array(
						"type" => "array",
						"key" => array("type" => "int"),
						"value" => array("type" => "bool")
					)
				)
			)
		);

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats', 'setStoats', 'setBoats', 'setGroats'));

		$mock->expects($this->once())->method('setGoats')->with($this->identicalTo(
			array(
				0 => array("baa" => "moo", "fish" => "wobble"),
				1 => array("florp" => "stoat", "goat" => "fork")
				)
			)
		);
		$mock->expects($this->once())->method('setStoats')->with($this->identicalTo(
			array(
				"foo" => array("blip" => array(2 => "woo", 5 => "wee", 1 => "nay", 0 => "yay")),
				"oof" => array("blap" => array(0 => "woo"), "barp" => array(6 => "oof"))
				)
			)
		);
		$mock->expects($this->once())->method('setBoats')->with($this->identicalTo("bloop"));
		$mock->expects($this->once())->method('setGroats')->with($this->identicalTo(array(true, false, true, true, false)));

		DummyClassA::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);


		$input = array(
			"goats" =>
				array(
					0 => array("baa" => "moo", "fish" => "wobble"),
					1 => array("florp" => "stoat", "goat" => "fork")
				),
			"stoats" =>
				array(
					"foo" => array("blip" => array(2 => "woo", 5 => "wee", 1 => "nay", 0 => "yay")),
					"oof" => array("blap" => array(0 => "woo"), "barp" => array(6 => "oof"))
				),
			"boats" => "bloop",
			"groats" => array(0 => true, 1 => false, 2 => true, 3 => true, 4 => false),
		);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassA', $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallObjects() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyClassA',
				"properties" => array(
					"goats" => array(
						"type" => "string"
					),
					"snorks" => array(
						"type" => "ref",
						"ref" => "DummyClassC"
					),
					"notes" => array(
						"type" => "ref",
						"ref" => "DummyClassB"
					),
					"groats" => array(
						"type" => "bool"
					),
				)
			),
			"DummyClassB" => array(
				"type" => __NAMESPACE__ . "\\DummyClassB",
				"properties" => array(
					"flibble" => array(
						"type" => "string"
					),
					"flobble" => array(
						"type" => "ref",
						"ref" => "DummyClassD"
					)
				)
			),
			"DummyClassC" => array(
				"type" => __NAMESPACE__ . "\\DummyClassC"
			),
			"DummyClassD" => array(
				"type" => __NAMESPACE__ . "\\DummyClassD",
				"properties" => array(
					"arfArf" => array(
						"name" => "arfArf",
						"type" => "string"
					)
				)
			)
		);

		$mockD = $this->getMock(__NAMESPACE__ . '\DummyClassD', array('setArfArf'));
		$mockD->expects($this->once())->method('setArfArf')->with($this->identicalTo('AAAARF!'));


		$mockB = $this->getMock(__NAMESPACE__ . '\DummyClassB', array('setFlibble', 'setFlobble'));
		$mockB->expects(($this->once()))->method('setFlibble')->with($this->identicalTo("foo"));
		$mockB->expects(($this->once()))->method('setFlobble')->with($this->isInstanceOf(__NAMESPACE__ . '\DummyClassD'));

		$mockC = $this->getMock(__NAMESPACE__ . '\DummyClassC', array());

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats', 'setSnorks', 'setNotes', 'setGroats'));
		$mock->expects($this->once())->method('setGoats')->with($this->identicalTo("baa"));
		$mock->expects($this->once())->method('setSnorks')->with($this->isInstanceOf(__NAMESPACE__ . '\DummyClassC'));
		$mock->expects($this->once())->method('setNotes')->with($this->isInstanceOf(__NAMESPACE__ . '\DummyClassB'));
		$mock->expects($this->once())->method('setGroats')->with($this->identicalTo(false));

		DummyClassA::$mockery = $mock;
		DummyClassB::$mockery = $mockB;
		DummyClassC::$mockery = $mockC;
		DummyClassD::$mockery = $mockD;

		$marshaller = $this->_getMarshaller($config);


		$input = array(
			"goats" => "baa",
			"snorks" => array(),
			"notes" => array(
				"flibble" => "foo",
				"flobble" => array(
					"arfArf" => "AAAARF!"
				)
			),
			"groats" => false
		);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassA', $marshalled);
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallNulls() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyClassA',
				"properties" => array(
					"goats" => array(
						"type" => "string"
					),
					"stoats" => array(
						"type" => "array",
						"key" => array("type" => "int"),
						"value" => array("type" => "string")
					),
					"boats" => array(
						"type" => "float"
					),
					"groats" => array(
						"type" => "bool"
					),
				)
			),
		);

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats', 'setStoats', 'setBoats', 'setGroats'));

		$mock->expects($this->never())->method('setGoats');
		$mock->expects($this->once())->method('setStoats')->with($this->identicalTo(array(2 => null)));
		$mock->expects($this->once())->method('setBoats')->with($this->identicalTo(5.1));
		$mock->expects($this->never())->method('setGroats');

		DummyClassA::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$input = array(
			"stoats" => array(2 => null),
			"boats" => 5.1,
		);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassA', $marshalled);
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallJson() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyClassA',
				"properties" => array(
					"goats" => array(
						"type" => "string"
					),
					"stoats" => array(
						"type" => "json",
						"value" => array("type" => "ref", "ref" => "DummyClassB")
					)
				)
			),
			"DummyClassB" => array(
				"type" => __NAMESPACE__ . "\\DummyClassB",
				"properties" => array(
					"flibble" => array(
						"type" => "string"
					),
					"flobble" => array(
						"type" => "ref",
						"ref" => "DummyClassD"
					)
				),
			),
			"DummyClassD" => array(
				"type" => __NAMESPACE__ . "\\DummyClassD",
				"properties" => array(
					"arfArf" => array(
						"type" => "string"
					)
				)
			)
		);
		$mockD = $this->getMock(__NAMESPACE__ . '\DummyClassD', array('setArfArf'));
		$mockD->expects($this->once())->method('setArfArf')->with($this->identicalTo('AAAARF!'));

		$mockB = $this->getMock(__NAMESPACE__ . '\DummyClassB', array('setFlibble', 'setFlobble'));
		$mockB->expects(($this->once()))->method('setFlibble')->with($this->identicalTo("foo"));
		$mockB->expects(($this->once()))->method('setFlobble')->with($this->isInstanceOf(__NAMESPACE__ . '\DummyClassD'));

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setGoats', 'setStoats'));

		$mock->expects($this->once())->method('setGoats')->with($this->identicalTo("foo"));
		$mock->expects($this->once())->method('setStoats')->with($this->isInstanceOf(__NAMESPACE__ . '\DummyClassB'));

		DummyClassA::$mockery = $mock;
		DummyClassB::$mockery = $mockB;
		DummyClassD::$mockery = $mockD;

		$marshaller = $this->_getMarshaller($config);

		$input = array(
			"goats" => "foo",
			"stoats" => json_encode(array(
				"flibble" => "foo",
				"flobble" => array(
					"arfArf" => "AAAARF!"
				)), true)
		);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassA', $marshalled);
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallWithDiscriminators() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyClassA',
				"discriminator" => array(
					"options" => array(
						"array" => array(
							"options" => array(
								"name" => "tipe"
							)
						)
					),
					"property" => "tripe",
					"values" => array(
						"Flork" => "DummyClassAA",
						"fLark" => "DummyClassAB"
					)
				)
			),
			"DummyClassAA" => array(
				"type" => __NAMESPACE__ . "\\DummyClassAA",
				"properties" => array(
					"foo" => array(
						"name" => "foo",
						"type" => "string"
					)
				)
			),
			"DummyClassAB" => array(
				"type" => __NAMESPACE__ . "\\DummyClassAB",
			)
		);

		$mockAA = $this->getMock(__NAMESPACE__ . '\DummyClassAA', array('setFoo', 'setTripe'));
		$mockAA->expects($this->once())->method('setFoo')->with($this->identicalTo('bar'));
		$mockAA->expects($this->once())->method('setTripe')->with($this->identicalTo('Flork'));

		$mockAB = $this->getMock(__NAMESPACE__ . '\DummyClassAB', array('setTripe'));
		$mockAB->expects($this->once())->method('setTripe')->with($this->identicalTo('fLark'));

		$mock = $this->getMock(__NAMESPACE__ . '\DummyClassA', array('setTripe'));
        $mock->expects($this->once())->method('setTripe')->with($this->identicalTo("dunno"));

		DummyClassA::$mockery = $mock;
		DummyClassAA::$mockery = $mockAA;
		DummyClassAB::$mockery = $mockAB;

		$marshaller = $this->_getMarshaller($config);

		$input = array(
			"tipe" => "Flork",
			"foo" => "bar",
		);
		$marshalled = $marshaller->unmarshall($input, "DummyClassA");
		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassAA', $marshalled);

		$input = array(
			"tipe" => "fLark",
		);
		$marshalled = $marshaller->unmarshall($input, "DummyClassA");
		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassAB', $marshalled);

		$input = array(
			"tipe" => "dunno",
		);
		$marshalled = $marshaller->unmarshall($input, "DummyClassA");
		$this->assertInstanceOf(__NAMESPACE__ . '\DummyClassA', $marshalled);
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @expectedException \RuntimeException
	 */
	public function testUnmarshallWithMissingDiscriminatorMethod() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyNoCall',
				"discriminator" => array(
					"property" => "tripe",
					"values" => array(
						"fLark" => "DummyClassAB"
					)
				)
			),
			"DummyClassAB" => array(
				"type" => __NAMESPACE__ . "\\DummyNoCallB",
			)
		);

		$mockAB = $this->getMock(__NAMESPACE__ . '\DummyNoCallB', array());
		DummyClassAB::$mockery = $mockAB;

		$marshaller = $this->_getMarshaller($config);

		$input = array(
			"tripe" => "fLark"
		);

		$marshaller->unmarshall($input, "DummyClassA");
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::unmarshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_valueAsType
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_callSetter
	 */
	public function testUnmarshallConstructorArgs() {

		$config = array(
			"DummyClassA" => array(
				"type" => __NAMESPACE__ . '\DummyConstructor',
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
						"type" => "float"
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
				),
				"constructorArgs" => array(
					"goats",
					"stoats"
				)
			)
		);

		$input = array(
			"geets" => "baa",
			"stoats" => 1,
			"boats" => 5.1,
			"goats" => false
		);

		$mock = $this->getMock(__NAMESPACE__ . '\DummyConstructor', array('amConstruct', 'setGoats', 'setStoats', 'setBoats', 'setGroats'), array(), '', false);

		$mock->expects($this->once())->method('amConstruct')->with($this->identicalTo("baa"), $this->identicalTo(1));
		$mock->expects($this->never())->method('setGoats');
		$mock->expects($this->never())->method('setStoats');
		$mock->expects($this->once())->method('setBoats')->with($this->identicalTo(5.1));
		$mock->expects($this->once())->method('setGroats')->with($this->identicalTo(false));

		DummyConstructor::$mockery = $mock;

		$marshaller = $this->_getMarshaller($config);

		$marshalled = $marshaller->unmarshall($input, "DummyClassA");

		$this->assertInstanceOf(__NAMESPACE__ . '\DummyConstructor', $marshalled);

	}
}

class DummyClassA {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(static::$mockery, $name), $args);
	}

}

class DummyClassB {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(static::$mockery, $name), $args);
	}
}

class DummyClassC {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(static::$mockery, $name), $args);
	}
}

class DummyClassD {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(static::$mockery, $name), $args);
	}
}

class DummyClassAA extends DummyClassA {
	public static $mockery;

}

class DummyClassAB extends DummyClassA {
	public static $mockery;

}

class DummyNoCall {
	public static $mockery;

	public function setGoats($a) {
		static::$mockery->setGoats($a);
	}
	public function setStoats($a) {
		static::$mockery->setStoats($a);
	}
	public function setBoats($a) {
		static::$mockery->setBoats($a);
	}
	public function setGroats($a) {
		static::$mockery->setGroats($a);
	}
}

class DummyNoCallB extends DummyNoCall {
	public static $mockery;

}

class DummyConstructor {
	public static $mockery;

	public function __construct($a, $b, $c = "bloop") {
		static::$mockery->amConstruct($a, $b, $c);
	}

	public function __call($name, $args) {
		return call_user_func_array(array(static::$mockery, $name), $args);
	}
}