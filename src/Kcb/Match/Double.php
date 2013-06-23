<?php

namespace Kcb\Match;

use Kcb\Match;
use Kcb\Match\Team;
use Kcb\Round;

class Double extends Match {

    public function __construct(Round $round) {
        parent::__construct($round, new Team($this), new Team($this));
    }

}