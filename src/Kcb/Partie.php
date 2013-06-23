<?php

namespace Kcb;

abstract class Partie {

    protected $ersteSeite;
    protected $zweiteSeite;

    public function __construct(Seite $ersteSeite, Seite $zweiteSeite) {
        $this->ersteSeite = $ersteSeite;
        $this->zweiteSeite = $zweiteSeite;
    }

    /** @return Seite[] */
    public function getSeiten() {
        return array($this->ersteSeite, $this->zweiteSeite);
    }

    public function getSpieler() {
        $spieler = new SpielerMenge();
        $spieler->addAll($this->ersteSeite->getSpieler());
        $spieler->addAll($this->zweiteSeite->getSpieler());
        return $spieler;
    }

}