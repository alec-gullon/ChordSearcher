<?php

namespace App\Services;

use App\Model\ChordDiagram;
use App\Model\NotesMatrix;

/**
 * Service that builds all possible alternative voicings of a provided chord
 *
 * @property    \App\Model\NeckSection  $neckSection
 * @property    array                   $notes
 */
class ChordSearcher {

    /**
     * Instance of \App\Model\NeckSection
     *
     * @var object
     */
    private $neckSection;

    /**
     * Set of notes to search for alternative voicings for. No repetition.
     *
     * @var array
     */
    private $notes = [];

    /**
     * @param \App\Model\NeckSection    $section
     */
    public function __construct($section) {
        $this->neckSection = $section;
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
        while($this->neckSection->barPosition <= 12) {
            $notesMatrix = new NotesMatrix($this->neckSection->notes);
            $notesMatrix->buildMatchingCoordinates($this->notes);
            $notesMatrix->buildAdmissibleCoordinateSets($this->notes);
            $coordinateSets = $notesMatrix->coordinateSets;

            foreach($coordinateSets as $coordinateSet) {
                $diagrams[] = new ChordDiagram($this->neckSection->barPosition, $coordinateSet);
                $diagrams[0]->viewData();
            }
            $this->neckSection->advanceBar();
        }

        return $diagrams;
    }

    /**
     * Set up the notes based on a chord
     *
     * @param array     $notes
     */
    public function setNotes($notes) {
        foreach($notes as $note) {
            if( !in_array($note, $this->notes)) {
                $this->notes[] = $note;
            }
        }
    }

}