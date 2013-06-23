<?php

namespace Kcb\Match;

use Kcb\Match\Double;
use Kcb\MatchFactory;
use Kcb\Round;

class DoubleFactory implements MatchFactory {

    public function createMatch(Round $round) {
        return new Double($round);
    }

}