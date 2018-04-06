<?php

use App\Controllers\Controller;
use App\Factories\StringFactory;

$stringFactory = new StringFactory();

$controller = new Controller($stringFactory);
$controller->index();