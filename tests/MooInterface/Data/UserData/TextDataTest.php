<?php
namespace MooPhp\MooInterface\Data\UserData;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;
use MooPhp\MooInterface\Data\Types\Font;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class TextDataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\UserData\TextData
     */
    public function testMarshallTextData()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $textData = new TextData();
        $textData->setLinkId("amtext");
        $textData->setColour(new ColourRGB());
        $textData->setAlignment("left");
        $textData->setFont(new Font());
        $textData->setPointSize(3.142);
        $textData->setText("HELLO WORLD!");

        $json = $om->writeString($textData, '\MooPhp\MooInterface\Data\UserData\Datum');

        $this->assertEquals($textData, $om->readString($json, '\MooPhp\MooInterface\Data\UserData\Datum'));


    }

}
