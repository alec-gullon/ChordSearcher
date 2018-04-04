<?php

namespace App\Controllers;

class Controller {

    /**
     * Creates all possible chords based on notes selected by a user
     *
     * @param \App\Services\ChordSearcher   $chordSearcher
     * @param Array                         $request
     */
    public function getChords($chordSearcher, $request) {
        $chordSearcher->setNotes($request['notes']);
        $diagrams = $chordSearcher->trawlNeck();
        require __DIR__ . '/../views/chord-display.php';
    }

}