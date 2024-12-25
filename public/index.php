<?php
session_start();

use app\controllers\SiteController;

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

// Initialize controller for the router
$userController = new \app\controllers\UserController();
$productController = new \app\controllers\ProductController();
$apiUserController = new \app\controllers\api\UserController();
$apiProductController = new \app\controllers\api\ProductController();
$apiProductColorController = new \app\controllers\api\ProductColorController();
$apiOrderItemController = new \app\controllers\api\OrderItemController();

// Create routes

// Get request
$app->router->get('/', [new SiteController(), 'home']);
$app->router->get('/sign-up', 'signUp');
$app->router->get('/sign-up/success', 'signUpSuccess');
$app->router->get('/login', 'login');
$app->router->get('/logout',[$userController, 'logout']);
$app->router->get('/user/edit', 'editProfile');
$app->router->get('/women', [$productController, 'women']);
$app->router->get('/men', [$productController, 'men']);
$app->router->get('/children', [$productController, 'children']);
$app->router->get('/user/forgot-password', 'forgotPassword');
$app->router->get('/product/search', [$productController, 'search']);
$app->router->get('/detailed-product', 'detailedProduct');
$app->router->get('/product/filter', [$productController, 'filter']);
$app->router->get('/cart', 'cart');
$app->router->get('/payment', 'payment');

// Post request
$app->router->post('/sign-up', [$userController, 'signUp']);
$app->router->post('/login', [$userController, 'login']);
$app->router->post('/user/edit',[$userController, 'editProfile']);
$app->router->post('/user/forgot-password', [$userController,'saveNewPassword']);

// API REQUEST
// get API
$app->router->get('/api/products', [$apiProductController, 'getProducts']);
$app->router->get('/api/detailed-product', [$apiProductController, 'getDetailedProduct']);
$app->router->get('/api/product-colors', [$apiProductColorController, 'getColors']);
$app->router->get('/api/order-items', [$apiOrderItemController, 'getOrderItemsByUserId']);

// post API
$app->router->post('/api/users/forgot-password', [$apiUserController, 'getEmailForgotPassword']);
$app->router->post('/api/users/otp', [$apiUserController, 'getOTPCode']);
$app->router->post('/api/order-items', [$apiOrderItemController,'addToCart']);

// put API

// delete API
$app->router->delete('/api/order-items/{id}', function ($id) {
    (new \app\controllers\api\OrderItemController())->deleteOrderItemById($id);
});

// patch API
$app->router->patch('/api/order-items/{id}', function ($id) {
    (new \app\controllers\api\OrderItemController())->updateOrderItemQuantityById($id);
});
$app->router->patch('/api/users/edit-password', [$apiUserController,'saveChangePassword']);


$app->run();