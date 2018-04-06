<?php

namespace App\Model;

/**
 * Class that identifies potential chord voicings amongst a four fret segment of
 * neck, open notes and muted strings
 *
 * @property array  $notes
 * @property array  $matchingCoordinates
 * @property array  $admissibleCoordinates
 * @property array  $maximalCoordinateSets
 * @property array  $augmentedNotes
 *
 * @todo this class is getting a bit bloated. Coordinate set is definitely a candidate for a new class...
 */

class NotesMatrix {

    /**
     * The notes to search through the matrix for matches
     *
     * @var array
     */
    private $notes;

    /**
     * The coordinates that are matched to the given notes
     *
     * @var array
     */
    private $matchingCoordinates = [];

    /**
     * The subsets of coordinates that produce chords that satisfy the requirements
     *
     * @var array
     */
    private $admissibleCoordinateSets = [];

    /**
     * The subsets of coordinates that are admissible and contain no smaller admissible subchord
     *
     * @var array
     */
    private $maximalCoordinateSets = [];

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
     * Combine the open notes with the array of notes given in the specified
     * region of the neck
     *
     * @param array    $matrix
     * @param array    $notes
     */
    public function __construct($matrix, $notes) {
        foreach(OPEN_NOTES as $note) {
            $this->augmentedNotes[1][] = $note['note'];
        }
        for($i = 2; $i <= count($matrix)+1; $i++) {
            $this->augmentedNotes[$i] = $matrix[$i-2];
        }

        $this->notes = $notes;
    }

    /**
     * Creates the final set of maximal coordinate sets
     *
     * @return array
     */
    public function getCoordinateSets() {
        $this->buildMatchingCoordinates();
        $this->buildAdmissibleCoordinateSets();
        $this->buildMaximalCoordinateSets();
        return $this->maximalCoordinateSets;
    }

    /**
     * Loops through every node in the augmentedNotes array and find matches to
     * the provided set of notes.
     */
    private function buildMatchingCoordinates() {
        for($i = 1; $i <= 5; $i++){
            for($j = 0; $j <= 5; $j++) {
                if ( in_array($this->augmentedNotes[$i][$j], $this->notes) ) {
                    $this->matchingCoordinates[] = [$i,$j];
                }
            }
        }
    }

    /**
     * Builds the coordinate sets that could represent a physically playable
     * chord. Uses a binary representation of integers from 0 to 2^(#matchingCoordinates)
     * to cycle through all possible permutations of matching coordinates
     */
    private function buildAdmissibleCoordinateSets() {
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
            if($this->isRedundant($coordinateSet)){
                continue;
            }
            $this->admissibleCoordinateSets[] = $coordinateSet;
        }
    }

    /**
     * Sorts through the admissible coordinate sets and picks out the largest possible parent
     * voicings for each
     */
    private function buildMaximalCoordinateSets() {

        for($i = 0; $i < count($this->admissibleCoordinateSets); $i++) {
            $validParent = true;
            $parent = $this->admissibleCoordinateSets[$i];
            for($j = $i+1; $j < count($this->admissibleCoordinateSets); $j++) {
                if($this->containedIn($parent, $this->admissibleCoordinateSets[$j])) {
                    $validParent = false;
                    break;
                }
            }
            if($validParent) {
                $this->maximalCoordinateSets[] = $parent;
            }
        }

    }

    /**
     * Determines if a coordinate set produces an admissible chord. Conditions to be admissible:
     *
     *      - All notes are played at least once
     *      - No two notes lie on same string
     *      - Has to have a note on the first bar (otherwise, will be repeated)
     *
     * @param array   $coordinateSet
     *
     * @return bool
     */
    private function isRedundant($coordinateSet) {

        if( count($coordinateSet) > 6 || count($coordinateSet) < count($this->notes) ) {
            return true;
        }

        $strings = $this->numberOfNotesOnString($coordinateSet);
        foreach($strings as $string) {
            if( $string > 1 ) {
                return true;
            }
        }

        $frets = $this->playedFrets($coordinateSet);
        if( !in_array(2, $frets)) {
            return true;
        }

        $playedNotes = $this->playedNotes($coordinateSet);
        if( count($playedNotes) !== count($this->notes) ) {
            return true;
        }


        return false;
    }

    /**
     * Determines the number of of notes on a string for a given coordinate set
     *
     * @param array     $coordinateSet
     *
     * @return array
     */
    private function numberOfNotesOnString($coordinateSet) {
        $count = [0,0,0,0,0,0];
        foreach($coordinateSet as $coordinate) {
            $count[$coordinate[1]]++;
        }
        return $count;
    }

    /**
     * Determines the frets that have been played for a given coordinate set
     *
     * @param array     $coordinateSet
     * @return array
     */
    private function playedFrets($coordinateSet) {
        $frets = [];
        foreach($coordinateSet as $coordinate) {
            $frets[] = $coordinate[0];
        }
        return $frets;
    }

    /**
     * Determines the notes that have been played for a given coordinate set
     *
     * @param array     $coordinateSet
     * @return array
     */
    private function playedNotes($coordinateSet) {
        $notes = [];
        foreach($coordinateSet as $coordinate) {
            $fret = $coordinate[0];
            $string = $coordinate[1];
            if( !in_array($this->augmentedNotes[$fret][$string], $notes) ){
                $notes[] = $this->augmentedNotes[$fret][$string];
            }
        }
        return $notes;
    }

    /**
     * Determines if the first set is contained as a subset of the second set
     *
     * @todo needs to be moved to a general helper function, this isn't the responsibility of NotesMatrix...
     *
     * @param array     $set1
     * @param array     $set2
     * @return bool
     */
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