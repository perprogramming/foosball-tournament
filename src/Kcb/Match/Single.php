<?php

namespace Kcb\Match;

use Kcb\Match;
use Kcb\Round;

class Single extends Match {

    public function __construct(Round $round) {
        parent::__construct($round, new Singleplayer($this), new Singleplayer($this));
    }

}