<?php

namespace Kcb;

class Satz {

    protected $toreErsteSeite;
    protected $toreZweiteSeite;

    public function setToreErsteSeite($toreErsteSeite) {
        $this->toreErsteSeite = $toreErsteSeite;
    }

    public function getToreErsteSeite() {
        return $this->toreErsteSeite;
    }

    public function setToreZweiteSeite($toreZweiteSeite) {
        $this->toreZweiteSeite = $toreZweiteSeite;
    }

    public function getToreZweiteSeite() {
        return $this->toreZweiteSeite;
    }

}