<?php

namespace app\models;

use app\core\Model;

class ReviewsModel extends Model
{
    protected $table = 'reviews';

    public function saveReview($orderItemId, $content, $userId) {
        $sql = "INSERT INTO $this->table (order_items_id, content, user_id) VALUES ($orderItemId, '$content', $userId)";
        return $this->excuteSql($sql);
    }

    public function getReviewByOrderId($orderId) {
        $sql = "SELECT * FROM $this->table WHERE order_items_id = $orderId";
        return $this->queryOneRow($sql);
    }

    public function getReviewByProductId($id)
    {
        $sql = "SELECT $this->table.*, users.avatar_link, users.username, oi.product_color, oi.size FROM $this->table JOIN order_items AS oi on order_items_id = oi.id JOIN users ON reviews.user_id = users.id WHERE oi.product_id = $id";
        return $this->queryManyRows($sql);
    }
}