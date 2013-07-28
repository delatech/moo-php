<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class FontSpecTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\FontSpec
     */
    public function testMarshallFontSpec()
    {

        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();
        $fontSpec = new FontSpec("myFont", true, true);
        $json = $om->writeString($fontSpec);
        $this->assertEquals($fontSpec, $om->readString($json, '\MooPhp\MooInterface\Data\FontSpec'));

        $fontSpec = new FontSpec("myFont", null, true);
        $json = $om->writeString($fontSpec);
        $decoded = json_decode($json, true);
        $this->assertEquals(array("fontFamily" => "myFont", "italic" => true), $decoded);
        $this->assertEquals($fontSpec, $om->readString($json, '\MooPhp\MooInterface\Data\FontSpec'));

    }

}
