<?php

namespace App\Factories;

use App\Model\ChordDiagram;

class ChordDiagramFactory {

    public function makeChordDiagram($bar, $notes) {
        return new ChordDiagram($bar, $notes);
    }

}