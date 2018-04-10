<?php

/**
 * The notes in the open position, from low to high string
 */

if(!defined('OPEN_NOTES')) {
    if(isset($_SESSION['OPEN_NOTES'])) {
        define('OPEN_NOTES', $_SESSION['OPEN_NOTES']);
    } else {
        define('OPEN_NOTES', [
            0 => [
                'label' => 'E',
                'note' => 'E'
            ],
            1 => [
                'label' => 'A',
                'note' => 'A'
            ],
            2 => [
                'label' => 'D',
                'note' => 'D'
            ],
            3 => [
                'label' => 'G',
                'note' => 'G'
            ],
            4 => [
                'label' => 'B',
                'note' => 'B'
            ],
            5 => [
                'label' => 'e',
                'note' => 'E'
            ]
        ]);
    }
}

/**
 * The twelve notes in Western music theory
 */

if(!defined('NOTES')) {
    define('NOTES', ['A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#']);
}