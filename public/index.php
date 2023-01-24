<?php

$app = require __DIR__ . '/../bootstrap.php';
$router = require CONFIG_PATH . '/routes.php';
$router($app);

$app->run();