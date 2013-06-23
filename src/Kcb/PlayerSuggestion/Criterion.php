<?php

namespace Kcb\PlayerSuggestion;

use Kcb\Player;
use Kcb\Side;

interface Criterion {

    public function score(Side $side, Player $player);

}