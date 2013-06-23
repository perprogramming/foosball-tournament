<?php

namespace Kcb\Kriterium;

use Kcb\Kriterium;
use Kcb\Spieler;

class Zufall implements Kriterium {

    public function bewerte(Spieler $spieler) {
        return rand();
    }

}