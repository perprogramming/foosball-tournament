<?php

namespace Kcb\PlayerSuggestion\Filter;

use Kcb\PlayerSuggestion\Filter;
use Kcb\Side;
use Kcb\Player;

class Filters implements Filter {

    /** @var Filter[] */
    protected $filter = array();

    public function add(Filter $filter) {
        $this->filter[] = $filter;
    }

    public function canPlay(Side $side, Player $player) {
        foreach ($this->filter as $filter) {
            if (!$filter->canPlay($side, $player)) {
                return false;
            }
        }
        return true;
    }

}