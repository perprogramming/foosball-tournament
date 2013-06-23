<?php

namespace Kcb\PlayerSuggestion\Criterion;

use Kcb\PlayerSuggestion\Criterion;
use Kcb\Side;
use Kcb\Player;

class WeightedCriteria implements Criterion {

    protected $criteria;

    public function __construct() {
        $this->criteria = new \SplObjectStorage();
    }

    public function add(Criterion $criterion, $weight) {
        $this->criteria->attach($criterion, $weight);
    }

    public function score(Side $side, Player $player) {
        $score = 0;
        foreach ($this->criteria as $criterion) {
            /** @var $criterion Criterion */
            $score += $criterion->score($side, $player) * $this->criteria[$criterion];
        }
        return $score;
    }

}