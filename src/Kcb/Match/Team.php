<?php

namespace Kcb\Match;

use Kcb\Side;

class Team extends Side {

    public function isFull() {
        return $this->players->count() == 2;
    }

}