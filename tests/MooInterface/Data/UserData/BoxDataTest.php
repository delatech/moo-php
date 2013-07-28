<?php
namespace MooPhp\MooInterface\Data\UserData;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class BoxDataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\UserData\BoxData
     */
    public function testMarshallBoxData()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $boxData = new BoxData();
        $boxData->setColour(new ColourRGB());
        $boxData->setLinkId("ambox");

        $json = $om->writeString($boxData, '\MooPhp\MooInterface\Data\UserData\Datum');

        $this->assertEquals($boxData, $om->readString($json, '\MooPhp\MooInterface\Data\UserData\Datum'));


    }

}
