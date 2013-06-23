<?php

namespace Kcb;

interface MatchFactory {

    /** @return Match */
    public function createMatch(Round $round);

}