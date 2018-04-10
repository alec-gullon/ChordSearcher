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
 * Include some simple business logic constants
 */

require __DIR__ . '/config/constants.php';

/**
 * Fire up the session
 */

session_start();

/**
 * Route the request
 */

require __DIR__ . '/routes/index.php';