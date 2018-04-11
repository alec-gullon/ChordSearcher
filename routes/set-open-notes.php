<?php

use App\Helpers\RequestHelper;
use App\Controllers\TuningController;

$request = RequestHelper::pullIntoArray(['E-string', 'A-string', 'D-string', 'B-string', 'G-string', 'e-string']);

$request = [
    'E-string' => 'D',
    'A-string' => 'A',
    'D-string' => 'D',
    'G-string' => 'G',
    'B-string' => 'B',
    'e-string' => 'E'
];

$controller = new TuningController();
$controller->setTuning($request);