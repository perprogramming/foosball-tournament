<?php

namespace Kcb;

abstract class Seite {

    protected $spieler;

    public function __construct() {
        $this->spieler = new SpielerMenge();
    }

    public function addSpieler(Spieler $spieler) {
        if ($this->isKomplett()) {
            throw new \RuntimeException("Diese Seite ist bereits komplett.");
        }
        $this->spieler->attach($spieler);
    }

    /** @return SpielerMenge */
    public function getSpieler() {
        return clone $this->spieler;
    }

    abstract public function isKomplett();

}