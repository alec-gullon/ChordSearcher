<?php

use App\Controllers\Controller;

use App\Factories\NeckSectionFactory;
use App\Factories\NotesMatrixFactory;
use App\Factories\StringFactory;
use App\Factories\ChordDiagramFactory;

use App\Services\ChordSearcher;

/**
 * Setup a Chord Searcher service
 */

$neckSectionFactory = new NeckSectionFactory();
$notesMatrixFactory = new NotesMatrixFactory();
$chordDiagramFactory = new ChordDiagramFactory();
$chordSearcher = new ChordSearcher($neckSectionFactory, $notesMatrixFactory, $chordDiagramFactory);

/**
 * Delegate to controller
 */

$stringFactory = new StringFactory();
$controller = new Controller($stringFactory);
$_POST['notes'] = ['F#','A','D'];
$controller->getChords($chordSearcher, $_POST);