<?php
namespace MooPhp\MooInterface\Data;

use Weasel\JsonMarshaller\JsonMapper;
use Weasel\JsonMarshaller\Config\AnnotationDriver;
use Weasel\WeaselDoctrineAnnotationDrivenFactory;

class PackTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\MooInterface\Data\Pack::addSide
     */
    public function testAddSide()
    {

        /**
         * @var Side[] $sides
         */
        $sides = array(
            new Side("image"),
            new Side("image", 7),
            new Side("image", 5),
            new Side("image")
        );

        $dSide = new Side("details");

        $pack = new Pack();
        $pack->addSide($sides[0]);
        $pack->addSide($sides[1]);
        $pack->addSide($sides[2]);
        $pack->addSide($sides[3]);
        $pack->addSide($dSide);

        $this->assertEquals(1, $sides[0]->getSideNum());
        $this->assertEquals(7, $sides[1]->getSideNum());
        $this->assertEquals(5, $sides[2]->getSideNum());
        $this->assertEquals(8, $sides[3]->getSideNum());
        $this->assertEquals(1, $dSide->getSideNum());

        $this->assertEquals(array(1 => $sides[0], 5 => $sides[2], 7 => $sides[1], 8 => $sides[3]),
            $pack->getSidesByType("image"));

        $this->assertEquals(array($sides[0], $sides[2], $sides[1], $sides[3], $dSide), $pack->getSides());

    }

    /**
     * @covers \MooPhp\MooInterface\Data\Pack::setSides
     */
    public function testSetSides()
    {
        /**
         * @var Side[] $sides
         */
        $sides = array(
            new Side("image"),
            new Side("image", 7),
            new Side("image", 5),
            new Side("image")
        );

        $dSide = new Side("details");

        $pack = new Pack();
        $pack->addSide($sides[0]);
        $pack->addSide($sides[1]);
        $pack->addSide($sides[2]);
        $pack->addSide($sides[3]);
        $pack->addSide($dSide);

        /**
         * @var Side[] $sides
         */
        $sides = array(
            new Side("image", 12),
            new Side("image", 13),
            new Side("image", 14),
            new Side("image", 25),
            new Side("details", 12)
        );

        $pack->setSides($sides);

        $this->assertEquals($sides, $pack->getSides());

    }

    /**
     * @covers \MooPhp\MooInterface\Data\Pack::setCards
     */
    public function testSetCards()
    {
        $pack = new Pack();

        /**
         * @var Side[] $sides
         */
        $sides = array(
            new Side("image", 12),
            new Side("image", 13),
            new Side("image", 14),
            new Side("image", 25),
            new Side("details", 12)
        );

        $pack->setSides($sides);

        /**
         * @var Card[] $cards
         */
        $cards = array(
            new Card(array(new CardSide("image", 14), new CardSide("details", 12))),
            new Card(array(new CardSide("image", 12), new CardSide("details", 12))),
            new Card(array(new CardSide("image", 25), new CardSide("details", 12))),
            new Card(array(new CardSide("image", 25), new CardSide("image", 14))),
            new Card(array(new CardSide("image", 25), new CardSide("image", 14)), 7),
            new Card(array(new CardSide("image", 25), new CardSide("image", 14))),
        );

        $pack->setCards($cards);

        $this->assertEquals(1, $cards[0]->getCardNum());
        $this->assertEquals(2, $cards[1]->getCardNum());
        $this->assertEquals(3, $cards[2]->getCardNum());
        $this->assertEquals(4, $cards[3]->getCardNum());
        $this->assertEquals(7, $cards[4]->getCardNum());
        $this->assertEquals(8, $cards[5]->getCardNum());

        $this->assertEquals($sides, $pack->getSides());
        $this->assertEquals($cards, $pack->getCards());

    }

    /**
     * @covers \MooPhp\MooInterface\Data\Pack::addCard
     */
    public function testAddCard()
    {
        $pack = new Pack();

        /**
         * @var Side[] $sides
         */
        $sides = array(
            new Side("image", 12),
            new Side("image", 13),
            new Side("image", 14),
            new Side("image", 25),
            new Side("details", 12)
        );

        $pack->setSides($sides);

        /**
         * @var Card[] $cards
         */
        $cards = array(
            new Card(array(new CardSide("image", 14), new CardSide("details", 12))),
            new Card(array(new CardSide("image", 12), new CardSide("details", 12))),
            new Card(array(new CardSide("image", 25), new CardSide("details", 12))),
            new Card(array(new CardSide("image", 25), new CardSide("image", 14))),
        );

        foreach ($cards as $card) {
            $pack->addCard($card);
        }

        $this->assertEquals(1, $cards[0]->getCardNum());
        $this->assertEquals(2, $cards[1]->getCardNum());
        $this->assertEquals(3, $cards[2]->getCardNum());
        $this->assertEquals(4, $cards[3]->getCardNum());

        $this->assertEquals($sides, $pack->getSides());
        $this->assertEquals($cards, $pack->getCards());

    }

    /**
     * @covers \MooPhp\MooInterface\Data\Pack
     */
    public function testMarshallPack()
    {
        $fact = new WeaselDoctrineAnnotationDrivenFactory();
        $om = $fact->getJsonMapperInstance();

        $pack = new Pack();
        $pack->setProductVersion(7);
        $pack->setProductCode("toast");
        $pack->setImageBasket(new ImageBasket());
        $pack->setCards(array(new Card()));
        $pack->setExtras(array(new Extra("foo", "bar")));
        $pack->setNumCards(22);
        $pack->setSides(array(new Side("details")));

        $json = $om->writeString($pack);

        $this->assertEquals($pack, $om->readString($json, '\MooPhp\MooInterface\Data\Pack'));


    }

}
