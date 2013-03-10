<?php
namespace MooPhp\Helper\Card;

use MooPhp\MooInterface\Data\Pack;
use MooPhp\MooInterface\Data\Card;

/**
 * A CardDistributor for evenly distributing cards.
 * Given a pack with a partially populated cards array this will re-populate the cards array, based on your configuration.
 * THIS WILL OVERWRITE THE EXISTING CARDS ARRAY!
 */
class SimpleConfigurableCardDistributor implements CardDistributor
{

    private $_distribution;

    /**
     * @param int[] $distribution An array of card num to %age. %ages are expected to total 100.
     * @return \MooPhp\Helper\Card\SimpleConfigurableCardDistributor
     * @throws \InvalidArgumentException
     */
    public function setDistribution(array $distribution)
    {
        $total = 0;
        foreach ($distribution as $line) {
            $total += $line;
        }
        if (abs($total - 100) > 0.005) {
            throw new \InvalidArgumentException("Distribution does not add up to 100%");
        }
        arsort($distribution);
        $this->_distribution = $distribution;
        return $this;
    }

    public function populate(Pack $pack)
    {
        if (empty($this->_distribution)) {
            throw new \RuntimeException("No distribution configuration, call setDistribution() first!");
        }
        $cards = $pack->getCards();
        if ($cards === null) {
            $cards = array();
        }
        if (empty($cards)) {
            throw new \RuntimeException("You have no cards, you are not going to space today.");
        }
        $need = $pack->getNumCards();
        $stillNeed = $need;
        if ($need < 0) {
            throw new \RuntimeException("Cards array contains more than the expected number of cards.");
        }
        /** @var $newCards Card[] */
        $newCards = array();
        foreach ($this->_distribution as $cardNum => $percentage) {
            $card = $pack->getCard($cardNum);
            if (!$card) {
                throw new \RuntimeException("Could not find card $cardNum in pack.");
            }
            for ($i = 0; $i < ($need * ($percentage / 100)); $i++) {
                $newCards[] = new Card($card->getCardSides());
                $stillNeed--;
                if ($stillNeed <= 0) {
                    break 2;
                }
            }
        }
        while ($stillNeed > 0) {
            foreach ($newCards as $card) {
                $newCards[] = new Card($card->getCardSides());
                $stillNeed--;
                if ($stillNeed <= 0) {
                    break;
                }
            }
        }
        $pack->setCards($newCards);

        return $pack;
    }
}
