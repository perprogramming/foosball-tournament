<?php

namespace Kcb\PlayerSuggestion\Filter;

use Kcb\Match;
use Kcb\Player;
use Kcb\PlayerSuggestion\Filter;
use Kcb\Side;

class StillPlaying implements Filter {

    public function canPlay(Side $side, Player $player) {
        foreach ($side->getTournament()->getMatchesWithPlayer($player) as $match) {
            /** @var $match Match */
            if (!$match->isFinished()) {
                return false;
            }
        }
        return true;
    }

}