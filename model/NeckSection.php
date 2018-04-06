<?php

namespace App\Model;

/**
 * Class that models a four fret section of the guitar neck
 *
 * @property int                            $bar
 * @property array                          $notes
 * @property \App\Factories\FretFactory     $fretFactory
 */

class NeckSection {

    /**
     * Where the bar is, expected value 1-12
     *
     * @var int
     */
    public $bar;

    /**
     * The set of four frets that define the neck section region
     *
     * @var array
     */
    public $notes = [];

    /**
     * Factory to make frets
     *
     * @var \App\Factories\FretFactory
     */
    private $fretFactory;

    /**
     * Set up the notes as a multi-dimensional array
     *
     * @param int                           $bar
     * @param \App\Factories\FretFactory    $fretFactory
     */
    public function __construct($bar, $fretFactory) {
        $this->bar = $bar;

        for($i = 0; $i <= 3; $i++) {
            $fret = $fretFactory->makeFret($bar+$i);
            $this->notes[] = $fret->notes;
        }

        $this->fretFactory = $fretFactory;
    }
}