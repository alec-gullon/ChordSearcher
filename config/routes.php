<?php

/**
 * Set the information the app needs about all the routes. Currently just records the request type that
 * should be expected for each route.
 */

$routes = [
    'GET@home',
    'GET@get-chords',
    'GET@set-open-notes'
];

if(!defined('ROUTES')) {
    define('ROUTES', $routes);
}