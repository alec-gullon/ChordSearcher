<?php

namespace App\Controllers;

use App\Services\Notes;

class TuningController {

    public function setTuning($request) {
        if(count($request) !== 6) {
            return;
        }
        $notesService = new Notes();
        $notesService->setOpenNotes([
            $request['E-string'],
            $request['A-string'],
            $request['D-string'],
            $request['G-string'],
            $request['B-string'],
            $request['e-string']
        ]);

        require __DIR__ . '/../routes/home.php';
    }

}