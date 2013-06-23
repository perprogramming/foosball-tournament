<?php

namespace Kcb\PlayerSuggestion;

use Kcb\Player;
use Kcb\Players;
use Kcb\PlayerSuggestion\Criterion\WeightedCriteria;
use Kcb\PlayerSuggestion\Filter\Filters;
use Kcb\Side;

class Suggestion {

    protected $filters;
    protected $criteria;

    public function __construct() {
        $this->filters = new Filters();
        $this->criteria = new WeightedCriteria();
    }

    public function addFilter(Filter $filter) {
        $this->filters->add($filter);
    }

    public function addCriterion(Criterion $criterion, $weight) {
        $this->criteria->add($criterion, $weight);
    }

    public function suggestPlayer(Players $players, Side $side) {
        $self = $this;

        $candidates = array_filter(
            $players->toArray(),
            function(Player $player) use ($side, $self) {
                return $self->filters->canPlay($side, $player);
            }
        );

        usort($candidates, function(Player $a, Player $b) use ($side, $self) {
            return $self->criteria->score($side, $a) - $this->criteria->score($side, $b);
        });

        return reset($candidates);
    }

}