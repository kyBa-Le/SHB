<?php

namespace app\models;

use app\core\Application;
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
        return $this->queryOneRow($sql);
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM $this->table";
        return $this->queryManyRows($sql);
    }

    public function searchProductsByKeyword($keyword)
    {
        $sql = "SELECT * FROM $this->table 
                WHERE product_name LIKE '%$keyword%' 
                OR category LIKE '%$keyword%'
                OR description LIKE '%$keyword%'";
        return $this->queryManyRows($sql);
    }

    public function saveNewProduct($product_name, $image_link, $category, $color, $price, $quantity, $description){
        $sql = "INSERT INTO Products (product_name, image_link, category, color, price, quantity, `description`) 
            VALUES ('$product_name', '$image_link', '$category', '$color', $price, $quantity, '$description')";
        return $this->excuteSql($sql);
    }

    public function updateProduct( $productId, $product_name, $image_link, $category, $price, $quantity, $description){
        $product_name = addslashes($product_name);
        $image_link = addslashes($image_link);
        $category = addslashes($category);
        $description = addslashes($description);
        $sql = "UPDATE $this->table SET 
                    product_name = '$product_name', 
                    image_link = '$image_link', 
                    category = '$category', 
                    price = $price, 
                    quantity = $quantity, 
                    description = '$description' 
                WHERE id = $productId";
        return $this->excuteSql($sql);
    }
}