<?php
namespace MooPhp\Helper\Card;

use MooPhp\MooInterface\Data\Pack;

interface CardDistributor
{

    /**
     * Given a Pack with populated sides, populate (potentially overwriting) the cards array.
     * The algorithm used for population is implementation specific.
     * @param Pack $pack
     * @return Pack
     */
    public function populate(Pack $pack);

}
