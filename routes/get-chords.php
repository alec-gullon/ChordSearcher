<?php

use App\Controllers\Controller;

use App\Factories\NeckSectionFactory;
use App\Factories\NotesMatrixFactory;
use App\Factories\StringFactory;
use App\Factories\ChordDiagramFactory;

use App\Services\Chords\Categorizer;
use App\Services\Chords\Searcher;

/**
 * Setup a Chord Searcher service
 */

$neckSectionFactory = new NeckSectionFactory();
$notesMatrixFactory = new NotesMatrixFactory();
$chordDiagramFactory = new ChordDiagramFactory();
$chordSearcher = new Searcher($neckSectionFactory, $notesMatrixFactory, $chordDiagramFactory);

$categorizer = new Categorizer();

/**
 * Delegate to controller
 */

$stringFactory = new StringFactory();
$controller = new Controller($stringFactory);
$controller->getChords($chordSearcher, $categorizer, $_GET);