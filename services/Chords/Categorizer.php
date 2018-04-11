<?php

namespace App\Services\Chords;

/**
 * Provides ways of categorizing an array of instances of App\Model\Chord
 *
 * @property array  $chords
 */

class Categorizer {

    /**
     * Array of chords provided to the Categorizer
     *
     * @var
     */
    private $chords;

    public function setChords($chords) {
        $this->chords = $chords;
    }

    /**
     * Arranges $this->>chords according to difficulty
     *
     * @return array
     */
    public function byDifficulty($chords) {
        $categorizedChords = [
            'Beginner' => [],
            'Intermediate' => [],
            'Expert' => []
        ];
        foreach($chords as $chord) {
            if($chord->difficulty() < CHORD_DIFFICULTIES['EASY'] ) {
                $key = 'Beginner';
            } else if ($chord->difficulty() < CHORD_DIFFICULTIES['INTERMEDIATE'] ) {
                $key = 'Intermediate';
            } else {
                $key = 'Expert';
            }
            $categorizedChords[$key][] = $chord;
        }
        return $categorizedChords;
    }

}