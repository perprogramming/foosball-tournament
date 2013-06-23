<?php

namespace Kcb\Round;

use Kcb\Match;
use Kcb\Player;
use Kcb\Round;
use Kcb\Side;
use Kcb\Tournament\HasPreliminaries;

class Preliminary extends Round {

    protected $tournament;

    public function __construct(HasPreliminaries $tournament) {
        $tournament->addPreliminary($this);
        parent::__construct($tournament);
        $this->tournament = $tournament;
    }

    /** @return Player */
    public function suggestPlayer(Side $side) {
        return $this->tournament->suggestPreliminaryPlayer($side);
    }

    /** @return boolean */
    public function isMatchFinished(Match $match) {
        return $this->tournament->isPreliminaryMatchFinished($match);
    }

    /** @return boolean */
    public function getWinningSideOfMatch(Match $match) {
        return $this->tournament->getWinningSideOfPreliminaryMatch($match);
    }

}