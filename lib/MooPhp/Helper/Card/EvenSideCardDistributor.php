<?php
namespace MooPhp\Helper\Card;

use MooPhp\MooInterface\Data\Pack;
use MooPhp\MooInterface\Data\Card;
use MooPhp\MooInterface\Data\CardSide;

/**
 * A CardDistributor for evenly distributing sides.
 * This does not have any interest in relationships between certain sides, it'll just blindly distribute them.
 */
class EvenSideCardDistributor implements CardDistributor
{

    /**
     * Given a Pack with populated sides, populate the cards array with an even distribution of cards.
     * This will not overwrite existing cards, but they will not be counted towards the evenness of the distribution.
     * @param Pack $pack
     * @throws \RuntimeException
     * @return Pack
     */
    public function populate(Pack $pack)
    {
        $cards = $pack->getCards();
        if ($cards === null) {
            $cards = array();
        }
        $need = $pack->getNumCards() - count($cards);
        if ($need < 0) {
            throw new \RuntimeException("Cards array contains more than the expected number of cards.");
        }
        $sidesByType = $pack->getSidesByType();
        $sides = null;
        foreach (array_keys($sidesByType) as $type) {
            reset($sidesByType[$type]);
        }
        unset($sides);
        while ($need > 0) {
            $cardSides = array();
            $sides = null;
            foreach (array_keys($sidesByType) as $type) {
                /** @noinspection PhpUnusedLocalVariableInspection */
                $eached = each($sidesByType[$type]);
                if ($eached === false) {
                    reset($sidesByType[$type]);
                    $eached = each($sidesByType[$type]);
                }
                if ($eached === false) {
                    continue;
                }
                $side = $eached["value"];
                $cardSides[] = CardSide::forSide($side);
            }
            unset($sides);
            $pack->addCard(new Card($cardSides));
            $need--;
        }
        return $pack;
    }
}
