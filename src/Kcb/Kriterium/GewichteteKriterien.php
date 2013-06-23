<?php

namespace Kcb\Kriterium;

use Kcb\Kriterium;
use Kcb\Partie;
use Kcb\PartieAware;
use Kcb\Seite;
use Kcb\SeiteAware;
use Kcb\Spieler;
use Kcb\Turnier;
use Kcb\TurnierAware;

class GewichteteKriterien implements Kriterium, TurnierAware, PartieAware, SeiteAware {

    protected $kriterien;

    public function __construct() {
        $this->kriterien = new \SplObjectStorage();
    }

    public function add(Kriterium $kriterium, $gewicht) {
        $this->kriterien->attach($kriterium, $gewicht);
    }

    public function setTurnier(Turnier $turnier = null) {
        foreach ($this->kriterien as $kriterium) {
            if ($kriterium instanceof TurnierAware) {
                $kriterium->setTurnier($turnier);
            }
        }
    }

    public function setPartie(Partie $partie = null) {
        foreach ($this->kriterien as $kriterium) {
            if ($kriterium instanceof PartieAware) {
                $kriterium->setPartie($partie);
            }
        }
    }

    public function setSeite(Seite $seite = null) {
        foreach ($this->kriterien as $kriterium) {
            if ($kriterium instanceof SeiteAware) {
                $kriterium->setSeite($seite);
            }
        }
    }

    public function bewerte(Spieler $spieler) {
        $gewicht = 0;
        foreach ($this->kriterien as $kriterium) {
            /** @var $kriterium Kriterium */
            $gewicht += $kriterium->bewerte($spieler) * $this->kriterien[$kriterium];
        }
        return $gewicht;
    }

}