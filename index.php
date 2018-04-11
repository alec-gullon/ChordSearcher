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
 * Fire up the session
 */

session_start();

/**
 * Include some simple business logic constants and routes config
 */

require __DIR__ . '/config/constants.php';
require __DIR__ . '/config/routes.php';

/**
 * Route the request
 */

require __DIR__ . '/routes/index.php';