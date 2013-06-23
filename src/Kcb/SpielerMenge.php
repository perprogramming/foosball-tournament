<?php

namespace Kcb;

class SpielerMenge extends \SplObjectStorage {

    /** @param $spieler Spieler[] */
    public function __construct(array $spieler = array()) {
        foreach ($spieler as $s) {
            $this->attach($s);
        }
    }

    public function attach(Spieler $spieler) {
        if ($this->contains($spieler)) {
            throw new \RuntimeException("Spieler bereits in dieser SpielerMenge");
        }
        parent::attach($spieler);
    }

    public function waehleAus(Kriterium $kriterium) {
        $spieler = $this->toArray();
        usort($spieler, function (Spieler $a, Spieler $b) use ($kriterium) {
            return $kriterium->bewerte($a) - $kriterium->bewerte($b);
        });
        return reset($spieler);
    }

    public function filtere(Filter $filter) {
        $spieler = $this->toArray();
        return new SpielerMenge(array_filter(
            $this->toArray(),
            function(Spieler $spieler) use ($filter) {
                return $filter->moeglich($spieler);
            }
        ));
    }

    public function toArray() {
        return iterator_to_array($this);
    }

}