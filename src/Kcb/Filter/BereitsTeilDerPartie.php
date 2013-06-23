<?php

namespace Kcb\Filter;

use Kcb\Filter;
use Kcb\Partie;
use Kcb\PartieAware;
use Kcb\Spieler;

class BereitsTeilDerPartie implements Filter, PartieAware {

    protected $partie;

    public function setPartie(Partie $partie = null) {
        $this->partie = $partie;
    }

    public function moeglich(Spieler $spieler) {
        return !$this->partie->getSpieler()->contains($spieler);
    }

}