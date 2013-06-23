<?php

namespace Kcb;

abstract class Round {

    protected $tournament;
    protected $matches = array();

    public function __construct(Tournament $tournament) {
        $this->tournament = $tournament;
    }

    public function getTournament() {
        return $this->tournament;
    }

    public function createMatch() {
        return $this->tournament->getMatchFactory()->createMatch($this);
    }

    public function addMatch(Match $match) {
        $this->matches[] = $match;
    }

    public function getMatches() {
        return $this->matches;
    }

    public function getMatchesWithPlayer(Player $player) {
        return array_filter($this->matches, function (Match $match) use ($player) {
            return $match->getPlayers()->contains($player);
        });
    }

    public function getMatchesWithSide(Side $side) {
        return array_filter($this->matches, function(Match $match) use ($side) {
            foreach ($match->getSides() as $s) {
                if ($s->equals($side)) {
                    return true;
                }
            }
            return false;
        });
    }

    /** @return Players */
    public function getPlayers() {
        $players = new Players();
        foreach ($this->matches as $match) {
            /** @var $match Match */
            $players->addAll($match->getPlayers());
        }
        return $players;
    }

    /** @return Player */
    abstract public function suggestPlayer(Side $side);
    /** @return boolean */
    abstract public function isMatchFinished(Match $match);
    /** @return boolean */
    abstract public function getWinningSideOfMatch(Match $match);

}