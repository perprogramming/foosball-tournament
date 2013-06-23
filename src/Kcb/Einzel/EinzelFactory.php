<?php

namespace Kcb\Einzel;

use Kcb\PartieFactory;

class EinzelFactory implements PartieFactory {

    public function createPartie() {
        return new Einzel();
    }

}