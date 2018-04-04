<?php

namespace App\Model;

/**
 * Class that models a four fret section of the guitar neck
 *
 * @package App\Model
 */

class NeckSection {

    /**
     * Where the bar is, integer expected value 1-12
     *
     * @var int
     */
    public $barPosition = 1;

    /**
     * A multidimensional array that contains the notes in the region of the
     * neck. Rows correspond to frets, columns to strings e.g, [2][4] is
     * the second fret from the bar, 4th string (G string)
     *
     * @var array
     */
    public $notes = [];

    public function __construct() {
        $this->determineNotes();
    }

    /**
     * Advances the bar and updates the notes in that section of the bar
     */
    public function advanceBar() {
        $this->barPosition++;
        $this->determineNotes();
    }

    /**
     * Determines the notes based on the current position of the bar
     */
    public function determineNotes() {
        $notes = [];
        for ($i = 1; $i <= 4; $i++) {
            $notes[$i] = barNotes($this->barPosition+($i-1));
        }
        $this->notes = $notes;
    }

}