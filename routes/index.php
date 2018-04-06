<?php

$route = $_SERVER['REQUEST_URI'];

/**
 * Check the request_uri against the routes files, throw a 404 if no corresponding route exists
 */

if($route === '/') {
    $route = '/home';
}

$directory = __DIR__ . $route . '.php';
if( file_exists($directory) ) {
    require $directory;
} else {
    require __DIR__ . '404.php';
}