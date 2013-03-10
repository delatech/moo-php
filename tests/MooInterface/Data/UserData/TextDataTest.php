<?php
namespace MooPhp\MooInterface\Data\UserData;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\ColourRGB;
use MooPhp\MooInterface\Data\Types\Font;

class TextDataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\TextData
     */
    public function testMarshallTextData()
    {
        $om = new JsonMapper(new AnnotationDriver());

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
