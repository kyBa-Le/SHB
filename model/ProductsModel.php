<?php

namespace app\model;

use app\core\Model;

class ProductsModel extends Model
{
    protected $table = 'products';

    public function getProductsSortedByPurchases() {
        $sql = "SELECT * FROM $this->table ORDER BY purchases DESC";
        return $this->queryManyRows($sql);
    }

    public function getPaginatedProductsByCategory($category, $page, $size) {
        $offset = ((int)$page - 1) * (int)$size;
        $sql = "SELECT * FROM $this->table WHERE category = '$category' LIMIT $size OFFSET $offset";
        return $this->queryManyRows($sql);
    }
}