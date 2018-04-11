<?php

namespace App\Helpers;

class NotesHelper {

    public static function advanceNote($note, $gap = 1) {
        $pos = array_search($note, NOTES);
        $pos = ($pos+$gap) % 12;
        return NOTES[$pos];
    }

    public static function barNotes($bar) {
        $notes = [];
        foreach($_SESSION['OPEN_NOTES'] as $note) {
            $notes[] = NotesHelper::advanceNote($note, $bar);
        }
        return $notes;
    }

}