<?php

namespace Kcb\PlayerSuggestion\Filter;

use Kcb\PlayerSuggestion\Filter;
use Kcb\Player;
use Kcb\Side;

class AlreadyInRound implements Filter {

    public function canPlay(Side $side, Player $player) {
        return !$side->getRound()->getPlayers()->contains($player);
    }

}