<?php

namespace App\Services\Chords;

use App\Model\ChordDiagram;
use App\Model\NotesMatrix;

/**
 * Service that builds all possible alternative voicings of a provided chord
 *
 * @property    \App\Factories\NeckSectionFactory   $neckSectionFactory
 * @property    \App\Factories\NotesMatrixFactory   $notesMatrixFactory
 * @property    \App\Factories\ChordDiagramFactory  $chordDiagramFactory
 * @property    array                               $notes
 */
class Searcher {

    /**
     * Instance of \App\Model\NeckSection
     *
     * @var object
     */
    private $neckSectionFactory;

    /**
     * Instance of \App\Model\NotesMatrixFactory
     *
     * @var object
     */
    private $notesMatrixFactory;

    /**
     * Instance of \App\Model\ChordDiagramFactory
     *
     * @var object
     */
    private $chordDiagramFactory;


    /**
     * Set of notes to search for alternative voicings for. No repetition.
     *
     * @var array
     */
    private $notes = [];

    /**
     * @param \App\Factories\NeckSectionFactory     $neckSectionFactory
     * @param \App\Factories\NotesMatrixFactory     $notesMatrixFactory
     * @parem \App\Factories\ChordDiagramFactory    $chordDiagramFactory
     */
    public function __construct($neckSectionFactory, $notesMatrixFactory, $chordDiagramFactory) {
        $this->neckSectionFactory = $neckSectionFactory;
        $this->notesMatrixFactory = $notesMatrixFactory;
        $this->chordDiagramFactory = $chordDiagramFactory;
    }

    /**
     * Set up the notes based on a chord
     *
     * @param array     $notes
     */
    public function setNotes($notes) {
        foreach($notes as $note) {
            if( !in_array($note, $this->notes) ) {
                $this->notes[] = $note;
            }
        }
    }

    /**
     * Combs through the neck and gathers all possible alternative voicings using
     * the selected notes
     *
     * @return array
     */
    public function trawlNeck() {
        $diagrams = [];

        // advance the bar as far as a full octave
        $bar = 1;
        while($bar <= 12) {

            $neckSection = $this->neckSectionFactory->makeNeckSection($bar);
            $notesMatrix = $this->notesMatrixFactory->makeNotesMatrix($neckSection->notes, $this->notes);

            $coordinateSets = $notesMatrix->getCoordinateSets();
            foreach($coordinateSets as $coordinateSet) {
                $diagrams[] = $this->chordDiagramFactory->makeChordDiagram($bar, $coordinateSet);
            }
            $bar++;

        }

        return $diagrams;
    }

}