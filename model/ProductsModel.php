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
}