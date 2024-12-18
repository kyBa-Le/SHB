<?php
session_start();

use app\controller\Rest;
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

// Get request
$app->router->get('/', [new SiteController(), 'home']);
$app->router->get('/sign-up', 'signUp');
$app->router->get('/sign-up/success', 'signUpSuccess');
$app->router->get('/login', 'login');
$app->router->get('/logout',[new SiteController(), 'logout']);
$app->router->get('/user/edit', 'editProfile');
$app->router->get('/women', [new SiteController(), 'women']);
$app->router->get('/men', [new SiteController(), 'men']);
$app->router->get('/children', [new SiteController(), 'children']);
$app->router->get('/user/forgot-password', 'forgotPassword');
$app->router->get('/product/search', [new SiteController(), 'search']);

// Post request
$app->router->post('/sign-up', [new SiteController(), 'signUp']);
$app->router->post('/login', [new SiteController(), 'login']);
$app->router->post('/user/edit',[new SiteController(), 'editProfile']);
$app->router->post('/user/forgot-password', [new SiteController(),'saveNewPassword']);

// API REQUEST
// get API
$app->router->get('/api/products', [new Rest(), 'getProducts']);

// post API
$app->router->post('/api/user/forgot-password', [new Rest(), 'getEmailForgotPassword']);
$app->router->post('/api/user/otp', [new Rest(), 'getOTPcode']);
$app->router->post('/api/user/edit/password', [new Rest(),'saveChangePassword']);


// API REQUEST
// get API
$app->router->get('/api/products', [new Rest(), 'getProducts']);

$app->run();