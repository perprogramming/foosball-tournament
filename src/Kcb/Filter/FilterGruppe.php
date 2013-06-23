<?php

namespace Kcb\Filter;

use Kcb\Filter;
use Kcb\Partie;
use Kcb\PartieAware;
use Kcb\Seite;
use Kcb\SeiteAware;
use Kcb\Spieler;
use Kcb\Turnier;
use Kcb\TurnierAware;

class FilterGruppe implements Filter, TurnierAware, PartieAware, SeiteAware {

    /** @var Filter[] */
    protected $filter = array();

    public function add(Filter $filter) {
        $this->filter[] = $filter;
    }

    public function setTurnier(Turnier $turnier = null) {
        foreach ($this->filter as $filter) {
            if ($filter instanceof TurnierAware) {
                $filter->setTurnier($turnier);
            }
        }
    }

    public function setPartie(Partie $partie = null) {
        foreach ($this->filter as $filter) {
            if ($filter instanceof PartieAware) {
                $filter->setPartie($partie);
            }
        }
    }

    public function setSeite(Seite $seite = null) {
        foreach ($this->filter as $filter) {
            if ($filter instanceof SeiteAware) {
                $filter->setSeite($seite);
            }
        }
    }

    public function moeglich(Spieler $spieler) {
        foreach ($this->filter as $filter) {
            if (!$filter->moeglich($spieler)) {
                return false;
            }
        }
        return true;
    }

}