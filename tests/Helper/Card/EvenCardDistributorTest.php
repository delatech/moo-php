<?php
namespace MooPhp\Helper\Card;

use MooPhp\MooInterface\Data\Pack;
use MooPhp\MooInterface\Data\Side;
use MooPhp\MooInterface\Data\Card;
use MooPhp\MooInterface\Data\CardSide;

class EvenCardDistributorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \MooPhp\Helper\Card\EvenCardDistributor
     * @expectedException \RuntimeException
     */
    public function testNewPackFail()
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

        $distributor = new EvenCardDistributor();
        $distributor->populate($pack);
    }

    /**
     * @covers \MooPhp\Helper\Card\EvenCardDistributor
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
        $pack->addCard(new Card(array(CardSide::forSide($sides[1]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 2));
        $pack->addCard(new Card(array(CardSide::forSide($sides[4]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 3));
        $pack->addCard(new Card(array(CardSide::forSide($sides[4]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 4));
        $pack->addCard(new Card(array(CardSide::forSide($sides[1]), CardSide::forSide($sides[6]), CardSide::forSide($sides[7])), 44));

        $distributor = new EvenCardDistributor();
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
                    3 => 10,
                    2 => 19,
                    5 => 20,
                ),
                "back" => array(
                    2 => 49,
                ),
                "middle" => array(
                    1 => 49,
                ),
            ),
            $counts
        );

    }

}
