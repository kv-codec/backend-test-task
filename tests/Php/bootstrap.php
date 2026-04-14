<?php

use Symfony\Component\Dotenv\Dotenv;

defined('PROJECT_ROOT') || define('PROJECT_ROOT', dirname(__DIR__, 2));

require PROJECT_ROOT . '/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    new Dotenv()->bootEnv(PROJECT_ROOT . '/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}
