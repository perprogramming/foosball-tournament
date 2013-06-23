<?php

namespace Kcb\Doppel;

use Kcb\Partie;

class Doppel extends Partie {

    public function __construct() {
        parent::__construct(new Team(), new Team());
    }

}