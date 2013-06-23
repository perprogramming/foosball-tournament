<?php

namespace Kcb\Match;

use Kcb\Side;

class Singleplayer extends Side {

    public function isFull() {
        return $this->players->count() == 1;
    }

}