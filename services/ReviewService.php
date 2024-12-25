<?php

namespace app\services;

use app\models\ReviewsModel;

class ReviewService
{
    private $reviewModel;
    public function __construct()
    {
        $this->reviewModel = new ReviewsModel();
    }

    public function createNewReview ($data) {
        $orderId = (int)$data['order_id'];
        $content = $data['content'];
        $userId = (int)$data['user_id'];
        return $this->reviewModel->saveReview($orderId, $content, $userId);
    }

    public function getReviewsByOrderId($orderId) {
        return $this->reviewModel->getReviewByOrderId($orderId);
    }

    public function getReviewsByProductId( $id)
    {
        $id = (int)$id;
        return $this->reviewModel->getReviewByProductId($id);
    }
}