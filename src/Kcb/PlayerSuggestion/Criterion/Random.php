<?php

namespace Kcb\PlayerSuggestion\Criterion;

use Kcb\PlayerSuggestion\Criterion;
use Kcb\Player;
use Kcb\Side;

class Random implements Criterion {

    public function score(Side $side, Player $player) {
        return rand();
    }

}