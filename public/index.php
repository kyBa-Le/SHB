<?php

use app\controller\SiteController;
require __DIR__ . "/../vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'database' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new app\core\Application($config);

// Create routes
$app->router->get('/', [new SiteController(), 'home']);
// Get request
$app->router->get('/sign-up', 'signUp');
// Post request
$app->router->post('/sign-up', [new SiteController(), 'signUp']);

$app->run();