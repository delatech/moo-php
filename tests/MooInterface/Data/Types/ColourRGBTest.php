<?php
namespace MooPhp\MooInterface\Data\Types;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;

class ColourRGBTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\ColourRGB
     */
    public function testMarshallColourRGB()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $colour = new ColourRGB(123, 11, 0);

        $json = $om->writeString($colour, '\MooPhp\MooInterface\Data\Types\Colour');

        $this->assertEquals($colour, $om->readString($json, '\MooPhp\MooInterface\Data\Types\Colour'));

    }

}
