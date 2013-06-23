<?php

namespace Kcb\PlayerSuggestion\Filter;

use Kcb\Player;
use Kcb\PlayerSuggestion\Filter;
use Kcb\Side;

class SingleKnockOut implements Filter {

    public function canPlay(Side $side, Player $player) {
        $matches = $side->getRound()->getMatchesWith($player);

    }

}