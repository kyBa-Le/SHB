<?php
session_start();

use app\controllers\api\Rest;
use app\controllers\ProductController;
use app\controllers\SiteController;
use app\controllers\UserController;

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
$app->router->get('/logout',[new UserController(), 'logout']);
$app->router->get('/user/edit', 'editProfile');
$app->router->get('/women', [new ProductController(), 'women']);
$app->router->get('/men', [new ProductController(), 'men']);
$app->router->get('/children', [new ProductController(), 'children']);
$app->router->get('/user/forgot-password', 'forgotPassword');
$app->router->get('/product/search', [new ProductController(), 'search']);
$app->router->get('/detailed-product', 'detailedProduct');
$app->router->get('/product/filter', [new ProductController(), 'filter']);
$app->router->get('/cart', 'cart');

// Post request
$app->router->post('/sign-up', [new UserController(), 'signUp']);
$app->router->post('/login', [new UserController(), 'login']);
$app->router->post('/user/edit',[new UserController(), 'editProfile']);
$app->router->post('/user/forgot-password', [new UserController(),'saveNewPassword']);

// API REQUEST
// get API
$app->router->get('/api/products', [new Rest(), 'getProducts']);
$app->router->get('/api/detailed-product', [new Rest(), 'getDetailedProduct']);
$app->router->get('/api/products/colors', [new Rest(), 'getColors']);
$app->router->get('/api/order-items', [new Rest(), 'getOrderItemsByUserId']);

// post API
$app->router->post('/api/user/forgot-password', [new Rest(), 'getEmailForgotPassword']);
$app->router->post('/api/user/otp', [new Rest(), 'getOTPCode']);
$app->router->post('/api/user/edit/password', [new Rest(),'saveChangePassword']);
$app->router->post('/api/order-items/update', [new Rest(), 'updateOrderItemQuantityById']);
$app->router->post('/api/order-items/delete', [new Rest(), 'deleteOrderItemById']);
$app->router->post('/api/order-items/add-to-cart', [new Rest(),'addToCart']);

$app->run();