<?php

namespace Kcb;

class Game {

    protected $match;
    protected $goalsFirstSide;
    protected $goalsSecondSide;

    public function __construct(Match $match, $goalsFirstSide, $goalsSecondSide) {
        $match->addGame($this);
        $this->match = $match;
        $this->goalsFirstSide = $goalsFirstSide;
        $this->goalsSecondSide = $goalsSecondSide;
    }

    public function getGoalsFirstSide() {
        return $this->goalsFirstSide;
    }

    public function getGoalsSecondSide() {
        return $this->goalsSecondSide;
    }

}