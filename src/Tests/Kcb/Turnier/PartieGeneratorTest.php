<?php

namespace Tests;

use Kcb\Doppel\Doppel;
use Kcb\Doppel\DoppelFactory;
use Kcb\Einzel\Einzel;
use Kcb\Filter\BereitsTeilDerPartie;
use Kcb\Filter\FilterGruppe;
use Kcb\Kriterium\GewichteteKriterien;
use Kcb\Kriterium\Zufall;
use Kcb\PartieGenerator;
use Kcb\Spieler;
use Kcb\Turnier;

class PartieGeneratorTest extends \PHPUnit_Framework_TestCase {

    public function testGeneriereSpiel() {
        $partieFactory = new DoppelFactory();
        $partieGenerator = new PartieGenerator();

        $partieGenerator->addFilter(new BereitsTeilDerPartie());
        $partieGenerator->addKriterium(new Zufall());

        $turnier = new Turnier();

        foreach (array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h') as $name) {
            $turnier->addTeilnehmer(new Spieler($name));
        }

        for ($n = 0; $n < 100; $n++) {
            $partie = $partieFactory->createPartie();
            $partieGenerator->generierePartie($turnier, $partie);
            $turnier->addPartie($partie);
        }
        var_dump($turnier->getPartien());
    }

}