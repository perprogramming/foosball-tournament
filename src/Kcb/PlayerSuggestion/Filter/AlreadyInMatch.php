<?php

namespace Kcb\PlayerSuggestion\Filter;

use Kcb\PlayerSuggestion\Filter;
use Kcb\Player;
use Kcb\Side;

class AlreadyInMatch implements Filter {

    public function canPlay(Side $side, Player $player) {
        return !$side->getMatch()->getPlayers()->contains($player);
    }

}