<?php

use App\Helpers\RequestHelper;

$route = $_SERVER['REQUEST_URI'];
$route = explode('/',$route)[1];

/**
 * Check the request_uri against the routes files, throw a 404 if no corresponding route exists
 */

if($route === '') {
    $route = 'home';
}

if( RequestHelper::requestType($route) === 'POST' && !RequestHelper::isPost() ) {
    $route = '404';
}

$directory = __DIR__ . '/' . $route . '.php';
if( file_exists($directory) ) {
    require $directory;
} else {
    require __DIR__ . '/404.php';
}