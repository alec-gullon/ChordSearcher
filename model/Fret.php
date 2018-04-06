<?php

namespace App\Model;

use App\Helpers\NotesHelper;

/**
 * Class that models a fret on the guitar neck
 *
 * @property    int     $bar
 * @property    array   $notes
 *
 * @package App\Model
 */

class Fret {

    /**
     * The fret number on the neck
     *
     * @int
     */
    public $bar;

    /**
     * The full set of six notes on the fret
     *
     * @array
     */
    public $notes;

    public function __construct($bar) {
        $this->bar = $bar;
        foreach(OPEN_NOTES as $note) {
            $this->notes[] = NotesHelper::advanceNote($note['note'], $bar);
        }
    }

}