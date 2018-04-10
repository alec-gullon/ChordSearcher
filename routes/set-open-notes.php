<?php

use App\Helpers\RequestHelper;
use App\Controllers\TuningController;

$request = RequestHelper::pullIntoArray(['E-string', 'A-string', 'D-string', 'B-string', 'G-string', 'e-string']);

$controller = new TuningController();
$controller->setTuning($request);