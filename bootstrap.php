<?php

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
const CONFIG_PATH = __DIR__ . '/configs';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = require CONFIG_PATH . '/container.php';
AppFactory::setContainer($container);

return AppFactory::create();
