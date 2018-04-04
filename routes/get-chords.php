<?php

use App\Controllers\Controller;
use App\Model\NeckSection;
use App\Services\ChordSearcher;

/**
 * Setup a Chord Searcher service
 */

$neckSection = new NeckSection();
$chordSearcher = new ChordSearcher($neckSection);

/**
 * Delegate to controller
 */

$controller = new Controller();
$_POST['notes'] = ['D', 'A', 'F#'];
$diagrams = $controller->getChords($chordSearcher, $_POST);