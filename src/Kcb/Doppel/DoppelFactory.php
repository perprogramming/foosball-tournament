<?php

namespace Kcb\Doppel;

use Kcb\PartieFactory;

class DoppelFactory implements PartieFactory {

    public function createPartie() {
        return new Doppel();
    }

}