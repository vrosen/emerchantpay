<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Request-With');

header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/config.php';

$app = new \Slim\App(['settings' => $config]);

require __DIR__ . '/../app/bootstrap.php';

require __DIR__ . '/../routes/routes.php';

$app->run();