<?php

namespace Kcb\Tournament;

use Kcb\Game;
use Kcb\Match;
use Kcb\MatchFactory;
use Kcb\Player;
use Kcb\PlayerSuggestion\Filter\AlreadyInRound;
use Kcb\PlayerSuggestion\Filter\AlreadyInMatch;
use Kcb\PlayerSuggestion\Filter\StillPlaying;
use Kcb\PlayerSuggestion\Criterion\Random;
use Kcb\PlayerSuggestion\Suggestion;
use Kcb\Round\Finals;
use Kcb\Round\Preliminary;
use Kcb\Round;
use Kcb\Side;
use Kcb\Tournament;

class SwissSystem extends Tournament implements HasPreliminaries, HasFinals {

    protected $preliminariesSuggestion;
    protected $finalsSuggestions;
    protected $preliminaries = array();
    protected $finals;

    public function __construct(MatchFactory $matchFactory) {
        parent::__construct($matchFactory);

        $this->preliminariesSuggestion = new Suggestion();
        $this->preliminariesSuggestion->addCriterion(new Random(), 1);
        $this->preliminariesSuggestion->addFilter(new AlreadyInRound());
        $this->preliminariesSuggestion->addFilter(new AlreadyInMatch());
        $this->preliminariesSuggestion->addFilter(new StillPlaying());

        $this->finalsSuggestions = new Suggestion();
        $this->finalsSuggestions->addCriterion(new Random(), 1);
        $this->finalsSuggestions->addFilter(new AlreadyInMatch());
        $this->finalsSuggestions->addFilter(new StillPlaying());
    }

    public function createFinals() {
        return new Finals($this);
    }

    public function setFinals(Finals $finals) {
        parent::addRound($finals);
        $this->finals = $finals;
    }

    /** @return Finals */
    public function getFinals() {
        return $this->finals;
    }

    public function createPreliminary() {
        return new Preliminary($this);
    }

    public function addPreliminary(Preliminary $preliminary) {
        parent::addRound($preliminary);
        $this->preliminaries[] = $preliminary;
    }

    /** @return Preliminary[] */
    public function getPreliminaries() {
        return $this->preliminaries;
    }

    /** @return Player */
    public function suggestFinalsPlayer(Side $side) {
        return $this->finalsSuggestions->suggestPlayer($this->getPlayers(), $side);
    }

    /** @return Player */
    public function suggestPreliminaryPlayer(Side $side) {
        return $this->preliminariesSuggestion->suggestPlayer($this->getPlayers(), $side);
    }

    /** @return boolean */
    public function isFinalesMatchFinished(Match $match) {
        if (count($match->getGames())) {
            if (array_sum(array_map(
                $match->getGames(),
                function(Game $game) {
                    return ($game->getGoalsFirstSide() == 5) ? 1 : 0;
                }
            )) == 3) {
                return true;
            }
            if (array_sum(array_map(
                $match->getGames(),
                function(Game $game) {
                    return ($game->getGoalsSecondSide() == 5) ? 1 : 0;
                }
            )) == 3) {
                return true;
            }
        }
        return false;
    }

    /** @return boolean */
    public function getWinningSideOfFinalsMatch(Match $match) {
        if ($match->isFinished()) {
            if (array_sum(array_map(
                $match->getGames(),
                function(Game $game) {
                    return ($game->getGoalsFirstSide() == 5) ? 1 : 0;
                }
            )) == 3) {
                return $match->getFirstSide();
            }
            if (array_sum(array_map(
                $match->getGames(),
                function(Game $game) {
                    return ($game->getGoalsSecondSide() == 5) ? 1 : 0;
                }
            )) == 3) {
                return $match->getSecondSide();
            }
        }
        return null;
    }

    /** @return boolean */
    public function isPreliminaryMatchFinished(Match $match) {
        if (count($match->getGames())) {
            /** @var $firstGame Game */
            $firstGame = reset($match->getGames());
            if ($firstGame->getGoalsFirstSide() == 6) {
                return true;
            } elseif ($firstGame->getGoalsSecondSide() == 6) {
                return true;
            } elseif (($firstGame->getGoalsFirstSide() + $firstGame->getGoalsSecondSide()) == 10) {
                return true;
            }
        }
        return false;
    }

    /** @return Side|null */
    public function getWinningSideOfPreliminaryMatch(Match $match) {
        if ($match->isFinished()) {
            /** @var $firstGame Game */
            $firstGame = reset($match->getGames());
            if ($firstGame->getGoalsFirstSide() > $firstGame->getGoalsSecondSide()) {
                return $match->getFirstSide();
            } elseif ($firstGame->getGoalsFirstSide() < $firstGame->getGoalsSecondSide()) {
                return $match->getSecondSide();
            }
        }
        return null;
    }

}