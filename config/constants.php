<?php

/**
 * The notes in the open position, from low to high string
 */

if( !($_SESSION['OPEN_NOTES']) ) {
    $_SESSION['OPEN_NOTES'] = [
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
    ];
}

/**
 * The twelve notes in Western music theory
 */

if(!defined('NOTES')) {
    define('NOTES', ['A', 'A#', 'B', 'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#']);
}

/**
 * The thresholds for the difficulty of a chord
 */

if( !defined('CHORD_DIFFICULTIES') ) {
    define('CHORD_DIFFICULTIES', [
        'EASY' => 24,
        'INTERMEDIATE' => 32,
        'EXPERT' => 10000
    ]);
}