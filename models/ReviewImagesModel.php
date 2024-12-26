<?php

namespace app\models;

use app\core\Model;

class ReviewImagesModel extends Model
{
    protected $table = 'review_images';

    public function saveImage($imageLink, $reviewId) {
        $sql = "INSERT INTO review_images (image_link, review_id) VALUES ('$imageLink', $reviewId)";
        return $this->excuteSql($sql);
    }

    public function getReviewImagesByReviewId(int $id)
    {
        $sql = "SELECT * FROM review_images WHERE review_id = $id";
        return $this->queryManyRows($sql);
    }
}