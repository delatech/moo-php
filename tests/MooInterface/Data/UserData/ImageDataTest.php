<?php
namespace MooPhp\MooInterface\Data\UserData;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use MooPhp\MooInterface\Data\Types\BoundingBox;

class ImageDataTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\ImageData
     */
    public function testMarshallImageData()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $imageData = new ImageData();
        $imageData->setLinkId("amimage");
        $imageData->setEnhance(true);
        $imageData->setImageStoreFileId("asdasdasdasdasdasd");
        $imageData->setResourceUri("http://foobarbaz");
        $imageData->setImageBox(new BoundingBox());

        $json = $om->writeString($imageData, '\MooPhp\MooInterface\Data\UserData\Datum');

        $this->assertEquals($imageData, $om->readString($json, '\MooPhp\MooInterface\Data\UserData\Datum'));


    }

}
