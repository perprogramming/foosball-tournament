<?php

namespace Kcb\Einzel;

use Kcb\Seite;

class Spieler extends Seite {

    public function isKomplett() {
        return $this->spieler->count() == 1;
    }

}