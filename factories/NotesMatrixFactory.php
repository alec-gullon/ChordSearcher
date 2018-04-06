<?php

namespace App\Factories;

use App\Model\NotesMatrix;

class NotesMatrixFactory {

    public function makeNotesMatrix($matrix, $notes) {
        return new NotesMatrix($matrix, $notes);
    }

}