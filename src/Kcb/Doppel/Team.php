<?php

namespace Kcb\Doppel;

use Kcb\Seite;
use Kcb\Spieler;

class Team extends Seite {

    public function isKomplett() {
        return $this->spieler->count() == 2;
    }

}