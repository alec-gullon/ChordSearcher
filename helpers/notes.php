<?php

function advanceNote($note, $gap = 1) {
    $pos = array_search($note, NOTES);
    $pos = ($pos+$gap) % 12;
    return NOTES[$pos];
}

function barNotes($bar) {
    $notes = [];
    foreach(OPEN_NOTES as $note) {
        $notes[] = advanceNote($note, $bar);
    }
    return $notes;
}