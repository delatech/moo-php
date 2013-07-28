<?php
namespace MooPhp\MooInterface\Data\Types;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourCMYK;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class ColourCMYKTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Types\ColourCMYK
     */
    public function testMarshallColourCMYK()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $colour = new ColourCMYK(42.7, 1.32, 78.4);

        $json = $om->writeString($colour, '\MooPhp\MooInterface\Data\Types\Colour');

        $this->assertEquals($colour, $om->readString($json, '\MooPhp\MooInterface\Data\Types\Colour'));

    }

}
