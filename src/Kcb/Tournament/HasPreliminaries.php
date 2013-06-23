<?php

namespace Kcb\Tournament;

use Kcb\Match;
use Kcb\Player;
use Kcb\Round\Preliminary;
use Kcb\Side;

interface HasPreliminaries {

    public function addPreliminary(Preliminary $preliminary);
    /** @return Preliminary[] */
    public function getPreliminaries();
    /** @return Player */
    public function suggestPreliminaryPlayer(Side $side);
    /** @return boolean */
    public function isPreliminaryMatchFinished(Match $match);
    /** @return boolean */
    public function getWinningSideOfPreliminaryMatch(Match $match);

}