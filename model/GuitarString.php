<?php

namespace App\Model;

use App\Helpers\NotesHelper;

/**
 * Models a string on the guitar
 *
 * @property    string  $label
 * @property    string  $openNote
 *
 * @package App\Model
 */

class GuitarString {

    /**
     * The note played when the string is open
     *
     * @string
     */
    public $openNote;

    /**
     * Identifies the string
     *
     * @string
     */
    public $label;

    public function __construct($label, $openNote) {
        $this->openNote = $openNote;
        $this->label = $label;
    }

    /**
     * The note that is played on the given $fret
     *
     * @int     $fret
     *
     * @return string
     */
    public function fretNote($fret) {
        return NotesHelper::advanceNote($this->openNote, $fret);
    }

    /**
     * The full set of notes that can be played on the string, from low
     * to high
     *
     * @return array
     */
    public function notes() {
        $notes = [];
        for($i = 0; $i <= 16; $i++) {
            $notes[$i] = $this->fretNote($i);
        }
        return $notes;
    }

}