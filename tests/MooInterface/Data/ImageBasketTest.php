<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;

class ImageBasketTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @covers \MooPhp\MooInterface\Data\ImageBasket
     */
    public function testMarshallImageBasket()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $imageBasket = new ImageBasket();
        $imageBasket->setName("dave");
        $imageBasket->setType("onfire");
        $imageBasket->setItems(array(new ImageBasketItem()));
        $imageBasket->setImmutable(true);

        $json = $om->writeString($imageBasket);

        $this->assertEquals($imageBasket, $om->readString($json, '\MooPhp\MooInterface\Data\ImageBasket'));


    }

}
