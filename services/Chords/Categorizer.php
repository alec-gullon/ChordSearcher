<?php

namespace App\Services\Chords;

class Categorizer {

    private $chords;

    public function setChords($chords) {
        $this->chords = $chords;
    }

    public function byDifficulty($chords) {
        $categorizedChords = [
            'Beginner' => [],
            'Intermediate' => [],
            'Expert' => []
        ];
        foreach($chords as $chord) {
            if($chord->difficulty() < 24) {
                $categorizedChords['Beginner'][] = $chord;
            } else if ($chord->difficulty() < 32) {
                $categorizedChords['Intermediate'][] = $chord;
            } else {
                $categorizedChords['Expert'][] = $chord;
            }
        }
        return $categorizedChords;
    }

}