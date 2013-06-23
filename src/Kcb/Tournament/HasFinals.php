<?php

namespace Kcb\Tournament;

use Kcb\Match;
use Kcb\Player;
use Kcb\Round\Finals;
use Kcb\Side;

interface HasFinals {

    public function setFinals(Finals $finals);
    /** @return Finals */
    public function getFinals();
    /** @return Player */
    public function suggestFinalsPlayer(Side $side);
    /** @return boolean */
    public function isFinalesMatchFinished(Match $match);
    /** @return boolean */
    public function getWinningSideOfFinalsMatch(Match $match);

}