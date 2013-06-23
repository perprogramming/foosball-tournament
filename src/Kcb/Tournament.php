<?php

namespace Kcb;

use Kcb\PlayerSuggestion\Filter;

abstract class Tournament {

    protected $matchFactory;
    /** @var Players */
    protected $players;

    /** @var Round[] */
    protected $rounds = array();

    public function __construct(MatchFactory $matchFactory) {
        $this->matchFactory = $matchFactory;
        $this->players = new Players();
    }

    public function addRound(Round $round) {
        $this->rounds[] = $round;
    }

    /** @return Match[] */
    public function getMatchesWithPlayer(Player $player) {
        $matches = array();
        foreach ($this->rounds as $round) {
            foreach ($round->getMatchesWithPlayer($player) as $match) {
                $matches[] = $match;
            }
        }
        return $matches;
    }

    /** @return Match[] */
    public function getMatchesWithSide(Side $player) {
        $matches = array();
        foreach ($this->rounds as $round) {
            foreach ($round->getMatchesWithPlayer($player) as $match) {
                $matches[] = $match;
            }
        }
        return $matches;
    }

    public function getMatchFactory() {
        return $this->matchFactory;
    }

    public function addPlayer(Player $player) {
        $this->players->attach($player);
    }

    /** @return Players */
    public function getPlayers() {
        return clone $this->players;
    }

}