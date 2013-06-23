<?php

namespace Kcb\Einzel;

use Kcb\Partie;

class Einzel extends Partie {

    public function __construct() {
        parent::__construct(new Spieler(), new Spieler());
    }

}