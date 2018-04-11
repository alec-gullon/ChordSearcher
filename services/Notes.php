<?php

namespace App\Services;

class Notes {

    public function setOpenNotes($notes) {

        $_SESSION['OPEN_NOTES'] = [
            0 => [
                'label' => 'E',
                'note' => $notes[0]
            ],
            1 => [
                'label' => 'A',
                'note' => $notes[1]
            ],
            2 => [
                'label' => 'D',
                'note' => $notes[2]
            ],
            3 => [
                'label' => 'G',
                'note' => $notes[3]
            ],
            4 => [
                'label' => 'B',
                'note' => $notes[4]
            ],
            5 => [
                'label' => 'e',
                'note' => $notes[5]
            ]
        ];

    }

}