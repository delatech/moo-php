<?php
namespace MooPhp\MooInterface\Data\Types;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;

class BoundingBoxTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\BoundingBox
     */
    public function testMarshallBoundingBox()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $boundingBox = new BoundingBox();
        $boundingBox->setCentre(new Point());
        $boundingBox->setAngle(41.3);
        $boundingBox->setHeight(12.5);
        $boundingBox->setWidth(3.142);

        $json = $om->writeString($boundingBox);

        $this->assertEquals($boundingBox, $om->readString($json, '\MooPhp\MooInterface\Data\Types\BoundingBox'));


    }

}
