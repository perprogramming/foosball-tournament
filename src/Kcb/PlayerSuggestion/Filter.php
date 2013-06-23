<?php

namespace Kcb\PlayerSuggestion;

use Kcb\Player;
use Kcb\Side;

interface Filter {

    public function canPlay(Side $side, Player $player);

}