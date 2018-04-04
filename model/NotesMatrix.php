<?php

namespace App\Model;

/**
 * Class that identifies potential chord voicings amongst a four fret segment of
 * neck, open notes and muted strings
 *
 * @
 */

class NotesMatrix {

    /**
     * @todo
     *
     * @var array
     */
    private $matchingCoordinates = [];

    public $coordinateSets = [];

    /**
     * The augmented notes, a 6 by 6 multidimensional array.
     *
     * Row 1:       Open Notes
     * Row 2-5:     Four segment section of neck
     *
     * @var array
     */
    public $augmentedNotes = [];

    /**
     * @todo
     * @param $matrix
     */
    public function __construct($matrix) {
        $this->augmentedNotes[1] = OPEN_NOTES;
        for($i = 2; $i <= count($matrix)+1; $i++) {
            $this->augmentedNotes[$i] = $matrix[$i-1];
        }
    }

    /**
     * Loops through every node in the $augmentedNotes array and find matches to
     * the provided $notes array
     *
     * @param $notes
     */
    public function buildMatchingCoordinates($notes) {
        for($i = 1; $i <= 5; $i++){
            for($j = 0; $j <= 5; $j++) {
                if ( in_array($this->augmentedNotes[$i][$j], $notes) ) {
                    $this->matchingCoordinates[] = [$i,$j];
                }
            }
        }
    }

    /**
     * Builds the coordinate sets that could represent a physically playable
     * chord. Uses a binary representation of integers from 0 to 2^(#matchingCoordinates)
     * to cycle through all possible permutations of matching coordinates
     *
     * @param $notes
     */
    public function buildAdmissibleCoordinateSets($notes) {
        for($i = 0; $i < pow(2, count($this->matchingCoordinates)); $i++) {
            // split $i into its binary digits
            $binary = decbin($i);
            $parts = str_split($binary);

            $coordinateSet = [];
            for($j = 0; $j < count($parts); $j++) {
                if($parts[$j]) {
                    $coordinateSet[] = $this->matchingCoordinates[$j];
                }
            }
            if($this->isRedundant($coordinateSet, $notes)){
                continue;
            }
            $this->coordinateSets[] = $coordinateSet;
        }
    }

    /**
     * Determines if a coordinate set produces an admissible chord. Conditions to be admissible:
     *
     *      - All notes are played at least once
     *      - No two notes lie on same string
     *
     * @param $coordinateSet
     * @return bool
     */
    private function isRedundant($coordinateSet, $notes) {

        if(count($coordinateSet) > 6) {
            return true;
        }

        $accountedNotes = [];
        $accountedStrings = [];

        if(count($coordinateSet) < count($notes)+1 ) {
            return true;
        }

        foreach($coordinateSet as $coordinate) {
            $string = $coordinate[1];
            if( in_array($string, $accountedStrings) ) {
                return true;
            }
            $accountedStrings[] = $string;

            $note = $this->augmentedNotes[$coordinate[0]][$coordinate[1]];
            if( !in_array($note, $accountedNotes) ) {
                $accountedNotes[] = $note;
            }
        }

        if( count($accountedNotes) !== count($notes) ) {
            return true;
        }

        return false;
    }

}