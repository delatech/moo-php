<?php
namespace MooPhp\MooInterface\Data\Types;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class PointTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Types\Point
     */
    public function testMarshallPoint()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $point = new Point();
        $point->setX(845761.2);
        $point->setY(76164.123123);

        $json = $om->writeString($point);

        $this->assertEquals($point, $om->readString($json, '\MooPhp\MooInterface\Data\Types\Point'));


    }

}
