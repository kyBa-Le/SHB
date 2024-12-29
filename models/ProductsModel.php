<?php

namespace app\models;

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
  
    public function getProductById ($id) {
        $sql = "SELECT * FROM $this->table WHERE id = '$id'";
        return $this->queryOneRow($sql);
    }

    public function getFilteredProducts ($name, $price, $categories) {
        $sql = "SELECT * FROM $this->table 
            WHERE product_name LIKE '%$name%'
            AND (
                ($price = 500000 AND price <= 500000) OR
                ($price = 1000000 AND price <= 1000000) OR
                ($price = 1001000 AND price > 1001000)
            )
            AND category = '$categories'
            ORDER BY price DESC";
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
            ) ORDER BY price DESC";
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
            AND category = '$categories'
            ORDER BY price DESC";
        return $this->queryManyRows($sql);
    }

    public function updateQuantity($id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = '$quantity' WHERE id = '$id'";
        return $this->excuteSql($sql);
    }

    public function updatePurchases($id, $newPurchases)
    {
        $sql = "UPDATE $this->table SET purchases = '$newPurchases' WHERE id = '$id'";
        return $this->excuteSql($sql);
    }
}