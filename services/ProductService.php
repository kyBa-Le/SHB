<?php

namespace app\services;

use app\models\ProductsModel;

class ProductService
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }

    public function getTop4OutStandingProducts() {
        $products = $this->productModel->getProductsSortedByPurchases();
        return array_slice($products, 0, 4);
    }

    public function getProductsByCondition($category, $pageNo, $pageSize)
    {
        return $this->productModel->getPaginatedProductsByCategory($category, $pageNo, $pageSize);
    }

    public function getProductByName($name) {
        return $this->productModel->getProductsByName($name);
    }

    public function getProductById($id){
        return $this->productModel->getProductById($id);
    }

    public function getFilteredProducts ($data) {
        $name = $data['product-name'];
        $price = $data['filter-price'];
        $categories = $data['filter-categories'];
        if ($name &&  $price && $categories) {
            return $this->productModel->getFilteredProducts($name, $price, $categories);
        } elseif ($name && $categories && !$price) {
            return $this->productModel->getProductsByCategories($name, $categories);
        } elseif ($name && $price) {
            return $this->productModel->getProductsByPrice($name, $price);
        } elseif ($price && $categories) {
            return $this->productModel->getProductsByPriceCategories ($price, $categories);
        } elseif ($name) {
            return $this->productModel->getProductsByName ($name);
        }else {
            return $this->productModel->getProducts();
        }
    }

}