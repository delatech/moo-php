<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class ImageBasketItemImageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\ImageBasketItemImage
     */
    public function testMarshallImageBasketItemImage()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $imageBasketItemImage = new ImageBasketItemImage();
        $imageBasketItemImage->setResourceUri("fasdasdsddddd");
        $imageBasketItemImage->setType("flibble");
        $imageBasketItemImage->setHeight(768);
        $imageBasketItemImage->setWidth(1024);
        $imageBasketItemImage->setRotation(55.2);

        $json = $om->writeString($imageBasketItemImage);

        $this->assertEquals($imageBasketItemImage,
            $om->readString($json, '\MooPhp\MooInterface\Data\ImageBasketItemImage'));


    }

}
