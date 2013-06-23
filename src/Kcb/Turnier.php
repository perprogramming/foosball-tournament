<?php

namespace Kcb;

class Turnier {

    /** @var SpielerMenge */
    protected $teilnehmer;

    /** @var Partie[] */
    protected $partien = array();

    public function __construct() {
        $this->teilnehmer = new SpielerMenge();
    }

    public function addTeilnehmer(Spieler $spieler) {
        $this->teilnehmer->attach($spieler);
    }

    /** @return SpielerMenge */
    public function getTeilnehmer() {
        return clone $this->teilnehmer;
    }

    public function addPartie(Partie $partie) {
        $this->partien[] = $partie;
    }

    public function getPartien() {
        return $this->partien;
    }

}