<?php

use App\Controllers\PostController;
use App\Controllers\HomeController;
use App\Controllers\UserController;

//API routes
$app->group('/api', function ($app) {
    $app->group('/v1', function ($app) {
        $app->get('/posts', PostController::class . ':index');

        $app->get('/posts/{id}', PostController::class . ':show')->add(
            new \App\Middleware\ValidationMiddleware(['id' => 'numeric|min:1'])
        );

        $app->post('/login', UserController::class . ':login');

        $app->post('/posts', PostController::class . ':store')->add(new \App\Middleware\AuthMiddleware([
            'secret' => $app->getContainer()->settings['secret'],
            'server_name' => $app->getContainer()->settings['server_name'],
        ]));

        $app->post('/posts/{id}', PostController::class . ':update')->add(new \App\Middleware\AuthMiddleware([
            'secret' => $app->getContainer()->settings['secret'],
            'server_name' => $app->getContainer()->settings['server_name'],
        ]));
    });
});

//Web routes
$app->get('/', HomeController::class . ':index');