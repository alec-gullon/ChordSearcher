<?php

namespace App\Controllers;

class Controller {

    public $stringFactory;

    public function __construct($stringFactory) {
        $this->stringFactory = $stringFactory;
    }

    /**
     * Displays the initial note entry to the user
     */
    public function index() {
        $formData = $this->buildFormData();
        require __DIR__ . '/../views/home.php';
    }

    /**
     * Creates all possible chords based on notes selected by a user
     *
     * @param \App\Services\Chords\Searcher     $chordSearcher
     * @param \App\Services\Chords\Categorizer  $categorizer
     * @param Array                             $request
     */
    public function getChords($chordSearcher, $categorizer, $request) {
        $notes = [
            $request['E-string'],
            $request['A-string'],
            $request['D-string'],
            $request['G-string'],
            $request['B-string'],
            $request['e-string']
        ];
        foreach($notes as $key => $note) {
            if($note === 'X') {
                unset($notes[$key]);
            }
        }

        $chordSearcher->setNotes($notes);
        $chords = $chordSearcher->trawlNeck();

        $categorizer->setChords($chords);
        $categories = $categorizer->byDifficulty($chords);
        
        $formData = $this->buildFormData();
        require __DIR__ . '/../views/chord-display.php';
    }

    /**
     * Creates the data for the chord entry form
     *
     * @return  array
     */
    private function buildFormData() {
        $strings = $this->stringFactory->allStrings();

        $data['strings'] = [];
        foreach($strings as $string) {
            $data['strings'][$string->label] = [
                'label' => $string->label,
                'notes' => $string->notes()
            ];
        }
        return $data;
    }

}