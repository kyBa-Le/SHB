<?php

namespace app\controllers\api;

use app\services\ReviewImageService;

class ReviewImageController extends BaseController
{
    private $reviewImageService;

    public function __construct()
    {
        parent::__construct();
        $this->reviewImageService = new ReviewImageService();
    }

    public function reviewOrder() {
        $data = $this->request->getBody();
        $message['isSuccess'] = $this->reviewImageService->createReviewImage($data);
        $this->response->sendJson($message);
    }

    public function getReviewImagesByReviewId() {
        $data = $this->request->getBody();
        if ($data['review-id']) {
            $reviewImages = $this->reviewImageService->getReviewImagesByReviewId($data['review-id']);
            $this->response->sendJson($reviewImages);
        }
    }
}