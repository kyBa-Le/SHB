<?php

namespace app\controller;

use app\core\Application;

class Rest
{
    private $productController;
    private $request;
    private $response;
    public function __construct() {
        $this->request = Application::$app->request;
        $this->response = Application::$app->response;
        $this->productController = new ProductController();
    }

    public function getProducts() {
        $category = $this->request->getBody()['category'];
        $pageNo = $this->request->getBody()['pageNo'];
        $pageSize = $this->request->getBody()['pageSize'];
        $products = $this->productController->getProductsByCondition($category, $pageNo, $pageSize);
        $this->response->sendJson($products);
    }
}