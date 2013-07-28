<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class CardSideTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\CardSide
     */
    public function testMarshallCardSide()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $cardSide = new CardSide("details", 5);

        $json = $om->writeString($cardSide);

        $this->assertEquals($cardSide, $om->readString($json, '\MooPhp\MooInterface\Data\CardSide'));


    }

}
