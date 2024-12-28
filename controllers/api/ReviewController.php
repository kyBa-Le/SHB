<?php

namespace app\controllers\api;

use app\services\ReviewService;

class ReviewController extends  BaseController
{
    private $reviewService;
    public function __construct() {
        parent::__construct();
        $this->reviewService = new ReviewService();
    }

    public function reviewOrder() {
        $data = $this->request->getBody();
        $message['isSuccess'] = $this->reviewService->createNewReview($data);
        $review = $this->reviewService->getReviewsByOrderId($data['order_id']);
        $message['review'] = $review;
        $this->response->sendJson($message);
    }

    public function getReviews() {
        $data = $this->request->getBody();
        if ($data['order-item-id']) {
            $review = $this->reviewService->getReviewsByOrderId($data['order-item-id']);
            $this->response->sendJson($review);
        } else if($data['product-id']) {
            $reviews = $this->reviewService->getReviewsByProductId($data['product-id']);
            $this->response->sendJson($reviews);
        }
    }
}