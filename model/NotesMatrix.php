<?php

namespace App\Model;

/**
 * Class that identifies potential chord voicings amongst a four fret segment of
 * neck, open notes and muted strings
 *
 * @todo this class is getting a bit bloated. Coordinate set is definitely a candidate for a new class!
 */

class NotesMatrix {

    /**
     * @todo
     *
     * @var array
     */
    private $matchingCoordinates = [];

    public $coordinateSets = [];

    public $largestCoordinateSets = [];

    /**
     * The augmented notes, a 5 x 6 multidimensional array.
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
     * Sorts through the admissible coordinate sets and picks out the largest possible parent
     * voicings for each
     *
     * @param $notes
     */
    public function buildLargestCoordinateSets($notes) {

        $this->buildAdmissibleCoordinateSets($notes);

        for($i = 0; $i < count($this->coordinateSets); $i++) {
            $validParent = true;
            $parent = $this->coordinateSets[$i];
            for($j = $i+1; $j < count($this->coordinateSets); $j++) {
                if($this->containedIn($parent, $this->coordinateSets[$j])) {
                    $validParent = false;
                    break;
                }
            }
            if($validParent) {
                $this->largestCoordinateSets[] = $parent;
            }
        }

    }

    /**
     * @todo split into smaller methods
     * Determines if a coordinate set produces an admissible chord. Conditions to be admissible:
     *
     *      - All notes are played at least once
     *      - No two notes lie on same string
     *      - Has to have a note on the first bar (otherwise, will be repeated)
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
        $firstFretAccounted = false;

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

            if($coordinate[0] === 2) {
                $firstFretAccounted = true;
            }
        }

        if(!$firstFretAccounted) {
            return true;
        }

        if( count($accountedNotes) !== count($notes) ) {
            return true;
        }

        return false;
    }

    private function containedIn($set1, $set2) {
        if(count($set1) > count($set2)) {
            return false;
        }

        for($i = 0; $i < count($set1); $i++) {
            if(!in_array($set1[$i], $set2)) {
                return false;
            }
        }
        return true;
    }

}