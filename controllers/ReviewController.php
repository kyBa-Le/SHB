<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\services\OrderItemService;
use app\services\ReviewService;

class ReviewController extends Controller
{
    private $reviewService;
    private $orderItemService;
    public function __construct()
    {
        $this->reviewService = new ReviewService();
        $this->orderItemService = new OrderItemService();

    }

    public function show() {
        $orderId = Application::$app->request->getBody()['order-item-id'] ?? null;
        $orderItem = $this->orderItemService->getOrderItemById($orderId);
        return $this->render('review', ['orderItem' => $orderItem]);
    }
}