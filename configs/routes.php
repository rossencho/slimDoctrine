<?php

use Ross\SlimApi\Controllers\ProductController;
use Slim\App;

return function(App $app) {
    $app->post('/products', [ProductController::class, 'create']);
    $app->get('/products', [ProductController::class, 'getAll']);
    $app->get('/products/{id}', [ProductController::class, 'get']);
    $app->put('/products/{id}', [ProductController::class, 'update']);
    $app->delete('/products/{id}', [ProductController::class, 'delete']);
};
