<?php

namespace Tests;

use Kcb\Match\DoubleFactory;
use Kcb\Player;
use Kcb\Tournament\SwissSystem;

class MainTest extends \PHPUnit_Framework_TestCase {

    public function testTournament() {
        $tournament = new SwissSystem(new DoubleFactory());

        foreach (array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h') as $name) {
            $tournament->addPlayer(new Player($name));
        }

        $firstRound = $tournament->createPreliminary();
        $firstRound->createMatch();
        $firstRound->createMatch();

        $firstRound->createMatch();

        var_dump($firstRound);
    }

}