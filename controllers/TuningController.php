<?php

namespace App\Controllers;

class TuningController {

    public function setTuning($request) {
        if(count($request) !== 6) {
            return;
        }
        $_SESSION['OPEN_NOTES'] = [
            0 => [
                'label' => 'E',
                'note' => $request['E-string']
            ],
            1 => [
                'label' => 'A',
                'note' => $request['A-string']
            ],
            2 => [
                'label' => 'D',
                'note' => $request['D-string']
            ],
            3 => [
                'label' => 'G',
                'note' => $request['G-string']
            ],
            4 => [
                'label' => 'B',
                'note' => $request['B-string']
            ],
            5 => [
                'label' => 'e',
                'note' => $request['e-string']
            ]
        ];
    }

}