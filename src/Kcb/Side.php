<?php

namespace Kcb;

abstract class Side {

    protected $match;
    protected $players;

    public function __construct(Match $match) {
        $this->match = $match;
        $this->players = new Players();
    }

    public function getMatch() {
        return $this->match;
    }

    public function getRound() {
        return $this->match->getRound();
    }

    public function getTournament() {
        return $this->getRound()->getTournament();
    }

    public function isFirst() {
        return $this->match->getFirstSide() === $this;
    }

    public function isSecond() {
        return $this->match->getSecondSide() === $this;
    }

    public function addPlayer(Player $player) {
        if ($this->isFull()) {
            throw new \RuntimeException("This side is already full.");
        }
        $this->players->attach($player);
    }

    public function equals(Side $other) {
        if ($this->getPlayers()->count() != $other->getPlayers()->count()) {
            return false;
        }
        foreach ($this->getPlayers() as $player) {
            if (!$other->getPlayers()->contains($player)) {
                return false;
            }
        }
        return true;
    }

    /** @return Players */
    public function getPlayers() {
        return clone $this->players;
    }

    abstract public function isFull();

}