<?php

namespace Kcb;

class Player {

    /** @var string */
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

}