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

    public function getProductsByName ($name) {
        $sql = "SELECT * FROM $this->table WHERE product_name LIKE '%$name%'";
        return $this->queryManyRows($sql);
    }

    public function getFilteredProducts ($name, $price, $categories) {
        $sql = "SELECT * FROM $this->table 
            WHERE product_name LIKE '%$name%'
            AND (
                ($price = 500000 AND price <= 500000) OR
                ($price = 1000000 AND price <= 1000000) OR
                ($price = 1001000 AND price > 1001000)
            )
            AND category = '$categories'";
        return $this->queryManyRows($sql);
    }

    public function getProductsByCategories ($name, $categories) {
        $sql = "SELECT * FROM $this->table 
            WHERE product_name LIKE '%$name%'
            AND category = '$categories'";
        return $this->queryManyRows($sql);
    }

    public function getProductsByPrice ($name, $price) {
        $sql = "SELECT * FROM $this->table 
            WHERE product_name LIKE '%$name%'
            AND (
                ($price = 500000 AND price <= 500000) OR
                ($price = 1000000 AND price <= 1000000) OR
                ($price = 1001000 AND price > 1001000)
            )";
        return $this->queryManyRows($sql);
    }

    public function getProducts () {
        $sql = "SELECT * FROM $this->table";
        return $this->queryManyRows($sql);
    }

    public function getProductsByPriceCategories ($price, $categories) {
        $sql = "SELECT * FROM $this->table 
            WHERE  (
                    ($price = 500000 AND price <= 500000) OR
                    ($price = 1000000 AND price <= 1000000) OR
                    ($price = 1001000 AND price > 1001000)
            )
            AND category = '$categories'";
        return $this->queryManyRows($sql);
    }
}