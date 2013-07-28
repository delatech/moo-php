<?php
namespace MooPhp\MooInterface\Data\UserData;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;
use MooPhp\MooInterface\Data\Types\Font;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class MultiLineTextDataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\MultiLineTextData
     */
    public function testMarshallMultiLineTextData()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $multiLineTextData = new MultiLineTextData();
        $multiLineTextData->setLinkId("amtext");
        $multiLineTextData->setColour(new ColourRGB());
        $multiLineTextData->setAlignment("left");
        $multiLineTextData->setFont(new Font());
        $multiLineTextData->setPointSize(3.142);
        $multiLineTextData->setText("HELLO WORLD!");

        $json = $om->writeString($multiLineTextData, '\MooPhp\MooInterface\Data\UserData\Datum');

        $this->assertEquals($multiLineTextData, $om->readString($json, '\MooPhp\MooInterface\Data\UserData\Datum'));


    }

}
