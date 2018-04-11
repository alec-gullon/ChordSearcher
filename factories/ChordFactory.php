<?php

namespace App\Factories;

use App\Model\Chord;

class ChordFactory {

    public function makeChordDiagram($bar, $notes) {
        return new Chord($bar, $notes);
    }

}