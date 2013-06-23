<?php

namespace Kcb;

use Kcb\PlayerSuggestion\Criterion;
use Kcb\PlayerSuggestion\Filter;

class Players extends \SplObjectStorage {

    /** @param $players Player[] */
    public function __construct(array $players = array()) {
        foreach ($players as $player) {
            $this->attach($player);
        }
    }

    public function attach(Player $player) {
        if ($this->contains($player)) {
            throw new \RuntimeException("Player is already in among this Players.");
        }
        parent::attach($player);
    }

    public function toArray() {
        return iterator_to_array($this);
    }

}