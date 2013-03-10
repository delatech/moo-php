<?php
namespace MooPhp\Helper\Card;

use MooPhp\MooInterface\Data\Pack;
use MooPhp\MooInterface\Data\Card;

/**
 * A CardDistributor for evenly distributing cards.
 * Given a pack with a partially populated cards array this will populate the rest, assuming you want a roughly
 * similar number of each card.
 */
class EvenCardDistributor implements CardDistributor
{

    public function populate(Pack $pack)
    {
        $cards = $pack->getCards();
        if ($cards === null) {
            $cards = array();
        }
        $have = count($cards);
        if ($have == 0) {
            throw new \RuntimeException("You have no cards, you are not going to space today.");
        }
        $need = $pack->getNumCards() - $have;
        if ($need < 0) {
            throw new \RuntimeException("Cards array contains more than the expected number of cards.");
        }
        while ($need > 0) {
            foreach ($pack->getCards() as $card) {
                $pack->addCard(new Card($card->getCardSides()));
                $need--;
                if ($need <= 0) {
                    break;
                }
            }
        }
        return $pack;
    }
}
