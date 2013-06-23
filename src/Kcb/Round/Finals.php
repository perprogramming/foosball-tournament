<?php

namespace Kcb\Round;

use Kcb\Match;
use Kcb\Player;
use Kcb\Round;
use Kcb\Side;
use Kcb\Tournament\HasFinals;

class Finals extends Round {

    protected $tournament;

    public function __construct(HasFinals $tournament) {
        $tournament->setFinals($this);
        parent::__construct($tournament);
        $this->tournament = $tournament;
    }

    /** @return Player */
    public function suggestPlayer(Side $side) {
        return $this->tournament->suggestFinalsPlayer($side);
    }

    /** @return boolean */
    public function isMatchFinished(Match $match) {
        return $this->tournament->isFinalesMatchFinished($match);
    }

    /** @return boolean */
    public function getWinningSideOfMatch(Match $match) {
        return $this->tournament->getWinningSideOfFinalsMatch($match);
    }

}