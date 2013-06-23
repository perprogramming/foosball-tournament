<?php

namespace Kcb;

use Kcb\Filter\FilterGruppe;
use Kcb\Kriterium\GewichteteKriterien;

class PartieGenerator {

    protected $filter;
    protected $kriterien;

    public function __construct() {
        $this->filter = new FilterGruppe();
        $this->kriterien = new GewichteteKriterien();
    }

    public function addFilter(Filter $filter) {
        $this->filter->add($filter);
    }

    public function addKriterium(Kriterium $kriterium, $gewicht = 1) {
        $this->kriterien->add($kriterium, $gewicht);
    }

    public function generierePartie(Turnier $turnier, Partie $partie) {
        $this->filter->setTurnier($turnier);
        $this->kriterien->setTurnier($turnier);
        $this->filter->setPartie($partie);
        $this->kriterien->setPartie($partie);
        foreach ($partie->getSeiten() as $seite) {
            /** @var $seite Seite */
            $this->filter->setSeite($seite);
            $this->kriterien->setSeite($seite);
            while (!$seite->isKomplett()) {
                $seite->addSpieler(
                    $turnier->getTeilnehmer()->filtere($this->filter)->waehleAus($this->kriterien)
                );
            }
            $this->filter->setSeite(null);
            $this->kriterien->setSeite(null);
        }
        $this->filter->setPartie(null);
        $this->kriterien->setPartie(null);
        $this->filter->setTurnier(null);
        $this->kriterien->setTurnier(null);
    }

}