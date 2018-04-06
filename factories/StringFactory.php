<?php

namespace App\Factories;

use App\Model\GuitarString;

class StringFactory {

    public function allStrings() {
        $strings = [];
        foreach(OPEN_NOTES as $note) {
            $strings[] = new GuitarString($note['label'], $note['note']);
        }
        return $strings;
    }

}