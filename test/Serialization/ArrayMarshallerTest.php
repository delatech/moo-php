<?php
/**
 * @package MooPhp
 * @author Jonathan Oddy <jonathan at woaf.net>
 * @copyright Copyright (c) 2011, Jonathan Oddy
 */
namespace ArrayMarshallerTests;

require_once(__DIR__ . "/../../MooPhp/autoloader.php");

class ArrayMarshallerTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @expectedException \InvalidArgumentException
	 */
	public function testMarshalNonObject() {
		$config = array(

		);

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);
		$marshaller->marshall("hello", "Test");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @expectedException \RuntimeException
	 */
	public function testMarshalNoConfigElement() {
		$config = array(

		);

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);
		$marshaller->marshall(new DummyClassA(), "Test");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 * @expectedException \RuntimeException
	 */
	public function testMarshallBadTypeConfig() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => "giraffe"
					)
				)
			)
		);

		$mock = $this->getMock('DummyClassA', array('getGoats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue("baa"));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshaller->marshall($mock, "DummyClassA");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 * @expectedException \RuntimeException
	 */
	public function testMarshallBadComplexTypeConfig() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => array(
							"giraffe",
							"hrhr"
						)
					)
				)
			)
		);

		$mock = $this->getMock('DummyClassA', array('getGoats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue("baa"));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshaller->marshall($mock, "DummyClassA");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 * @expectedException \RuntimeException
	 */
	public function testMarshallBadMethod() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => "string"
					)
				)
			)
		);

		$mock = $this->getMock('DummyClassA', array());

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshaller->marshall($mock, "DummyClassA");

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallPrimitives() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => "string"
					),
					"stoats" => array(
						"name" => "stoats",
						"type" => "int"
					),
					"boats" => array(
						"name" => "boats",
						"type" => "float"
					),
					"groats" => array(
						"name" => "goats",
						"type" => "bool"
					),
				)
			)
		);

		$mock = $this->getMock('DummyClassA', array('getGoats', 'getStoats', 'getBoats', 'getGroats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue("baa"));
		$mock->expects($this->once())->method('getStoats')->will($this->returnValue(1));
		$mock->expects($this->once())->method('getBoats')->will($this->returnValue(5.1));
		$mock->expects($this->once())->method('getGroats')->will($this->returnValue(false));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");

		$expected = array(
			"geets" => "baa",
			"stoats" => 1,
			"boats" => 5.1,
			"goats" => false
		);

		$this->assertSame($expected, $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallPrimativeArray() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => array(
							"array",
							array(
								"key" => "int",
								"value" => "string"
							)
						)
					),
					"stoats" => array(
						"name" => "stoats",
						"type" => array(
							"array",
							array(
								"key" => "int",
								"value" => "int"
							)
						)
					),
					"boats" => array(
						"name" => "boats",
						"type" => array(
							"array",
							array(
								"key" => "string",
								"value" => "float"
							)
						)
					),
					"groats" => array(
						"name" => "goats",
						"type" => array(
							"array",
							array(
								"key" => "int",
								"value" => "bool"
							)
						)
					)
				)
			)
		);

		$mock = $this->getMock('DummyClassA', array('getGoats', 'getStoats', 'getBoats', 'getGroats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue(array("baa", "bar", "fishpaste wobble")));
		$mock->expects($this->once())->method('getStoats')->will($this->returnValue(array(9 => 1, 2 => 7, 378 => 9, 44 => 8)));
		$mock->expects($this->once())->method('getBoats')->will($this->returnValue(array("arr" => 1.1, "pirates" => 6.1)));
		$mock->expects($this->once())->method('getGroats')->will($this->returnValue(array(true, false, true, true, false)));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");

		$expected = array(
			"geets" => array(0 => "baa", 1 => "bar", 2 => "fishpaste wobble"),
			"stoats" => array(9 => 1, 2 => 7, 378 => 9, 44 => 8),
			"boats" => array("arr" => 1.1, "pirates" => 6.1),
			"goats" => array(0 => true, 1 => false, 2 => true, 3 => true, 4 => false),
		);


		$this->assertSame($expected, $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallNestedArray() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => array(
							"array",
							array(
								"key" => "int",
								"value" => array(
									"array",
									array(
										"key" => "string",
										"value" => "string"
									)
								)
							)
						)
					),
					"stoats" => array(
						"name" => "stoats",
						"type" => array(
							"array",
							array(
								"key" => "string",
								"value" => array(
									"array",
									array(
										"key" => "string",
										"value" => array(
											"array",
											array (
												"key" => "int",
												"value" => "string"
											)
										)
									)
								)
							)
						)
					),
					"boats" => array(
						"name" => "boats",
						"type" => "string"
					),
					"groats" => array(
						"name" => "goats",
						"type" => array(
							"array",
							array(
								"key" => "int",
								"value" => "bool"
							)
						)
					)
				)
			)
		);

		$mock = $this->getMock('DummyClassA', array('getGoats', 'getStoats', 'getBoats', 'getGroats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue(
			array(
				0 => array("baa" => "moo", "fish" => "wobble"),
				1 => array("florp" => "stoat", "goat" => "fork")
				)
			)
		);
		$mock->expects($this->once())->method('getStoats')->will($this->returnValue(
			array(
				"foo" => array("blip" => array(2 => "woo", 5 => "wee", 1 => "nay", 0 => "yay")),
				"oof" => array("blap" => array(0 => "woo"), "barp" => array(6 => "oof"))
				)
			)
		);
		$mock->expects($this->once())->method('getBoats')->will($this->returnValue("bloop"));
		$mock->expects($this->once())->method('getGroats')->will($this->returnValue(array(true, false, true, true, false)));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");

		$expected = array(
			"geets" =>
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
			"goats" => array(0 => true, 1 => false, 2 => true, 3 => true, 4 => false),
		);


		$this->assertSame($expected, $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallObjects() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "goats",
						"type" => "string"
					),
					"snorks" => array(
						"name" => "snorks",
						"type" => array(
							"ref",
							"DummyClassC"
						)
					),
					"notes" => array(
						"name" => "notes",
						"type" => array(
							"ref",
							"DummyClassB"
						)
					),
					"groats" => array(
						"name" => "groats",
						"type" => "bool"
					),
				)
			),
			"DummyClassB" => array(
				"type" => "DummyClassB",
				"properties" => array(
					"flibble" => array(
						"name" => "flibble",
						"type" => "string"
					),
					"flobble" => array(
						"name" => "flobble",
						"type" => array(
							"ref",
							"DummyClassD"
						)
					)
				)
			),
			"DummyClassC" => array(
				"type" => "DummyClassC"
			),
			"DummyClassD" => array(
				"type" => "DummyClassD",
				"properties" => array(
					"arfArf" => array(
						"name" => "arfArf",
						"type" => "string"
					)
				)
			)
		);

		$mockD = $this->getMock('DummyClassD', array('getArfArf'));
		$mockD->expects($this->once())->method('getArfArf')->will($this->returnValue('AAAARF!'));

		$mockB = $this->getMock('DummyClassB', array('getFlibble', 'getFlobble'));
		$mockB->expects(($this->once()))->method('getFlibble')->will($this->returnValue("foo"));
		$mockB->expects(($this->once()))->method('getFlobble')->will($this->returnValue($mockD));

		$mockC = $this->getMock('DummyClassC', array());

		$mock = $this->getMock('DummyClassA', array('getGoats', 'getSnorks', 'getNotes', 'getGroats'));
		$mock->expects($this->once())->method('getGoats')->will($this->returnValue("baa"));
		$mock->expects($this->once())->method('getSnorks')->will($this->returnValue($mockC));
		$mock->expects($this->once())->method('getNotes')->will($this->returnValue($mockB));
		$mock->expects($this->once())->method('getGroats')->will($this->returnValue(false));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");

		$expected = array(
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

		$this->assertSame($expected, $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallNulls() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "geets",
						"type" => "string"
					),
					"stoats" => array(
						"name" => "stoats",
						"type" => array(
							"array",
							array(
								"key" => "int",
								"value" => "string"
							)
						)
					),
					"boats" => array(
						"name" => "boats",
						"type" => "float"
					),
					"groats" => array(
						"name" => "goats",
						"type" => "bool"
					),
				)
			),
		);

		$mock = $this->getMock('DummyClassA', array('getGoats', 'getStoats', 'getBoats', 'getGroats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue(null));
		$mock->expects($this->once())->method('getStoats')->will($this->returnValue(array(2 => null)));
		$mock->expects($this->once())->method('getBoats')->will($this->returnValue(5.1));
		$mock->expects($this->once())->method('getGroats')->will($this->returnValue(null));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");

		$expected = array(
			"stoats" => array(2 => null),
			"boats" => 5.1,
		);

		$this->assertSame($expected, $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallJson() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"properties" => array(
					"goats" => array(
						"name" => "goats",
						"type" => "string"
					),
					"stoats" => array(
						"name" => "stoats",
						"type" => array(
							"json",
							"DummyClassB"
						)
					)
				)
			),
			"DummyClassB" => array(
				"type" => "DummyClassB",
				"properties" => array(
					"flibble" => array(
						"name" => "flibble",
						"type" => "string"
					),
					"flobble" => array(
						"name" => "flobble",
						"type" => array(
							"ref",
							"DummyClassD"
						)
					)
				),
			),
			"DummyClassD" => array(
				"type" => "DummyClassD",
				"properties" => array(
					"arfArf" => array(
						"name" => "arfArf",
						"type" => "string"
					)
				)
			)
		);
		$mockD = $this->getMock('DummyClassD', array('getArfArf'));
		$mockD->expects($this->once())->method('getArfArf')->will($this->returnValue('AAAARF!'));

		$mockB = $this->getMock('DummyClassB', array('getFlibble', 'getFlobble'));
		$mockB->expects(($this->once()))->method('getFlibble')->will($this->returnValue("foo"));
		$mockB->expects(($this->once()))->method('getFlobble')->will($this->returnValue($mockD));

		$mock = $this->getMock('DummyClassA', array('getGoats', 'getStoats'));

		$mock->expects($this->once())->method('getGoats')->will($this->returnValue("foo"));
		$mock->expects($this->once())->method('getStoats')->will($this->returnValue($mockB));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");

		$expected = array(
			"goats" => "foo",
			"stoats" => json_encode(array(
				"flibble" => "foo",
				"flobble" => array(
					"arfArf" => "AAAARF!"
				)), true)
		);

		$this->assertSame($expected, $marshalled);

	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 */
	public function testMarshallWithDiscriminators() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"discriminator" => array(
					"name" => "tipe",
					"property" => "tripe",
					"values" => array(
						"Flork" => "DummyClassAA",
						"fLark" => "DummyClassAB"
					)
				)
			),
			"DummyClassAA" => array(
				"type" => "DummyClassAA",
				"properties" => array(
					"foo" => array(
						"name" => "foo",
						"type" => "string"
					)
				)
			),
			"DummyClassAB" => array(
				"type" => "DummyClassAB",
			)
		);

		$mockAA = $this->getMock('DummyClassAA', array('getFoo', 'getTripe'));
		$mockAA->expects($this->once())->method('getFoo')->will($this->returnValue('bar'));
		$mockAA->expects($this->once())->method('getTripe')->will($this->returnValue('Flork'));

		$mockAB = $this->getMock('DummyClassAB', array('getTripe'));
		$mockAB->expects($this->once())->method('getTripe')->will($this->returnValue('fLark'));

		$mock = $this->getMock('DummyClassA', array('getTripe'));
		$mock->expects($this->once())->method('getTripe')->will($this->returnValue("dunno"));

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshalled = $marshaller->marshall($mockAA, "DummyClassA");
		$expected = array(
			"tipe" => "Flork",
			"foo" => "bar",
		);
		$this->assertSame($expected, $marshalled);

		$marshalled = $marshaller->marshall($mockAB, "DummyClassA");
		$expected = array(
			"tipe" => "fLark",
		);
		$this->assertSame($expected, $marshalled);

		$marshalled = $marshaller->marshall($mock, "DummyClassA");
		$expected = array(
			"tipe" => "dunno",
		);
		$this->assertSame($expected, $marshalled);
	}

	/**
	 * @covers \MooPhp\Serialization\ArrayMarshaller::__construct
	 * @covers \MooPhp\Serialization\ArrayMarshaller::marshall
	 * @covers \MooPhp\Serialization\ArrayMarshaller::_propertyAsType
	 * @expectedException \RuntimeException
	 */
	public function testMarshallWithMissingDiscriminatorMethod() {

		$config = array(
			"DummyClassA" => array(
				"type" => 'DummyClassA',
				"discriminator" => array(
					"name" => "tipe",
					"property" => "tripe",
					"values" => array(
						"fLark" => "DummyClassAB"
					)
				)
			),
			"DummyClassAB" => array(
				"type" => "DummyClassAB",
			)
		);

		$mockAB = $this->getMock('DummyClassAB', array());

		$marshaller = new \MooPhp\Serialization\ArrayMarshaller($config);

		$marshaller->marshall($mockAB, "DummyClassA");
	}
}

class DummyClassA {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(self::$mockery, $name), $args);
	}
}

class DummyClassB {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(self::$mockery, $name), $args);
	}
}

class DummyClassC {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(self::$mockery, $name), $args);
	}
}

class DummyClassD {
	public static $mockery;

	public function __call($name, $args) {
		return call_user_func_array(array(self::$mockery, $name), $args);
	}
}

class DummyClassAA extends DummyClassA {

}

class DummyClassAB extends DummyClassA {

}

