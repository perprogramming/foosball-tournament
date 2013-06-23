<?php

namespace Kcb\Match;

use Kcb\MatchFactory;
use Kcb\Round;

class SingleFactory implements MatchFactory {

    public function createMatch(Round $round) {
        return new Single($round);
    }

}