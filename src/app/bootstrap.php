<?php

$container = $app->getContainer();

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'], $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['base_url'] = 'http://localhost:8000';
$container['upload_directory'] = __DIR__ . '/../public/uploads';
$container['upload_link_dir'] = 'uploads';

$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer(__DIR__ . '/../public/views');
};

$container['post_service'] = function ($c) {
    return new \App\Services\PostService($c['db']);
};

$container['file_service'] = function ($c) {
    return new \App\Services\FileService($c['db']);
};

$container['user_service'] = function ($c) {
    return new \App\Services\UserService($c['db']);
};
