<?php
namespace MooPhp\MooInterface\Data\Types;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;

class FontTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Font
     */
    public function testMarshallFont()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $font = new Font("myFontFamily", true, true);

        $json = $om->writeString($font);
        $this->assertEquals($font, $om->readString($json, '\MooPhp\MooInterface\Data\Types\Font'));

        $font = new Font("myFontFamily", true, null);

        $json = $om->writeString($font);
        $decoded = json_decode($json, true);
        $this->assertEquals(array("fontFamily" => "myFontFamily", "bold" => true), $decoded);
        $this->assertEquals($font, $om->readString($json, '\MooPhp\MooInterface\Data\Types\Font'));

    }

}
