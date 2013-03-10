<?php
namespace MooPhp\Helper\Card;

use MooPhp\MooInterface\Data\Pack;
use MooPhp\MooInterface\Data\Side;
use MooPhp\MooInterface\Data\Card;
use MooPhp\MooInterface\Data\CardSide;

class EvenSideCardDistributorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\Helper\Card\EvenSideCardDistributor
     */
    public function testNewPackDistribute()
    {

        $pack = new Pack();
        $pack->setNumCards(49);

        $sides = array(
            new Side("front", 1),
            new Side("front", 2),
            new Side("front", 3),
            new Side("front", 4),
            new Side("front", 5),
            new Side("back", 1),
            new Side("back", 2),
            new Side("middle", 1),
        );

        $pack->setSides($sides);

        $distributor = new EvenSideCardDistributor();
        $distributor->populate($pack);

        $this->assertEquals(49, $pack->getNumCards());

        $counts = array();
        foreach ($pack->getCards() as $card) {
            foreach ($card->getCardSides() as $cardSide) {
                $type = $cardSide->getSideType();
                $num = $cardSide->getSideNum();
                if (!isset($counts[$type])) {
                    $counts[$type] = array();
                }
                if (!isset($counts[$type][$num])) {
                    $counts[$type][$num] = 0;
                }
                $counts[$type][$num]++;
            }
        }

        $this->assertEquals(
            array(
                "front" => array(
                    1 => 10,
                    2 => 10,
                    3 => 10,
                    4 => 10,
                    5 => 9,
                ),
                "back" => array(
                    1 => 25,
                    2 => 24,
                ),
                "middle" => array(
                    1 => 49,
                ),
            ),
            $counts
        );

    }

    /**
     * @covers \MooPhp\Helper\Card\EvenSideCardDistributor
     */
    public function testExistingCardsDistribute()
    {

        $pack = new Pack();
        $pack->setNumCards(49);

        $sides = array(
            new Side("front", 1),
            new Side("front", 2),
            new Side("front", 3),
            new Side("front", 4),
            new Side("front", 5),
            new Side("back", 1),
            new Side("back", 2),
            new Side("middle", 1),
        );

        $pack->setSides($sides);

        $pack->addCard(new Card(array(CardSide::forSide($sides[2]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 1));
        $pack->addCard(new Card(array(CardSide::forSide($sides[2]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 2));
        $pack->addCard(new Card(array(CardSide::forSide($sides[2]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 3));
        $pack->addCard(new Card(array(CardSide::forSide($sides[2]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 4));
        $pack->addCard(new Card(array(CardSide::forSide($sides[2]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 44));

        $distributor = new EvenSideCardDistributor();
        $distributor->populate($pack);

        $this->assertEquals(49, $pack->getNumCards());

        $counts = array();
        foreach ($pack->getCards() as $card) {
            foreach ($card->getCardSides() as $cardSide) {
                $type = $cardSide->getSideType();
                $num = $cardSide->getSideNum();
                if (!isset($counts[$type])) {
                    $counts[$type] = array();
                }
                if (!isset($counts[$type][$num])) {
                    $counts[$type][$num] = 0;
                }
                $counts[$type][$num]++;
            }
        }

        $this->assertEquals(
            array(
                "front" => array(
                    3 => 14,
                    1 => 9,
                    2 => 9,
                    4 => 9,
                    5 => 8,
                ),
                "back" => array(
                    2 => 27,
                    1 => 22,
                ),
                "middle" => array(
                    1 => 49,
                ),
            ),
            $counts
        );

    }

}
