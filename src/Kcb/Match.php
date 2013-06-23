<?php

namespace Kcb;

abstract class Match {

    protected $round;
    protected $firstSide;
    protected $secondSide;
    protected $games = array();

    public function __construct(Round $round, Side $firstSide, Side $secondSide) {
        $this->round = $round;
        $this->firstSide = $firstSide;
        $this->secondSide = $secondSide;

        foreach ($this->getSides() as $side) {
            if (!$side->isFull()) {
                if (!($player = $round->suggestPlayer($side))) {
                    throw new \RuntimeException("Match cannot be created.");
                }
                $side->addPlayer($player);
            }
        }

        $round->addMatch($this);
    }

    public function getRound() {
        return $this->round;
    }

    public function getTournament() {
        return $this->round->getTournament();
    }

    public function getFirstSide() {
        return $this->firstSide;
    }

    public function getSecondSide() {
        return $this->secondSide;
    }

    public function addGame(Game $game) {
        $this->games[] = $game;
    }

    public function getGames() {
        return $this->games;
    }

    public function isFinished() {
        return $this->round->isMatchFinished($this);
    }

    public function getWinningSide() {
        return $this->round->getWinningSideOfMatch($this);
    }

    /** @return Side[] */
    public function getSides() {
        return array($this->firstSide, $this->secondSide);
    }

    /** @return Players */
    public function getPlayers() {
        $players = new Players();
        $players->addAll($this->firstSide->getPlayers());
        $players->addAll($this->secondSide->getPlayers());
        return $players;
    }

}