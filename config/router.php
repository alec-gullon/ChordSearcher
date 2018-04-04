<?php

$route = $_SERVER['REQUEST_URI'];

/**
 * Check the request_uri against the routes files, throw a 404 if no corresponding route exists
 */

$directory = __DIR__ . '/../routes' . $route . '.php';
if( file_exists($directory) ) {
    require $directory;
} else {
    require __DIR__ . '/../routes/404.php';
}