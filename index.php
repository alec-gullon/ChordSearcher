<?php

/**
 * ChordSearcher - PhP Based Side Project
 *
 * @package ChordSearcher
 * @author Alec Gullon
 */

/**
 * Call in the composer autoloader file
 */

require __DIR__ . '/vendor/autoload.php';

/**
 * Bootstrap the application. Include some simple business logic constants and a loader
 * file which pulls in all of the classes.
 */

require __DIR__ . '/config/constants.php';
require __DIR__ . '/config/loader.php';

/**
 * Route the request
 */

require __DIR__ . '/config/router.php';