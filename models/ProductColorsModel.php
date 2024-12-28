<?php

namespace app\models;

use app\core\Model;

class ProductColorsModel extends Model
{
    protected $table='product_colors';

    public function getProductColorsByProductId($productId) {
        $sql = "SELECT * FROM $this->table WHERE product_id=$productId";
        return $this->queryManyRows($sql);
    }
}