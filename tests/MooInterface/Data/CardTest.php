<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;

class CardTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Card
     */
    public function testMarshallCard()
    {
        $om = new JsonMapper(new AnnotationDriver());

        $card = new Card();
        $card->setCardNum(12);
        $card->setCardSides(array(new CardSide("details", 5)));

        $json = $om->writeString($card);

        $this->assertEquals($card, $om->readString($json, '\MooPhp\MooInterface\Data\Card'));


    }

}
