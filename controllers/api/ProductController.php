<?php

namespace app\controllers\api;

use app\core\Application;
use app\models\ProductsModel;
use app\services\ProductService;

class ProductController extends BaseController
{
    private $productService;

    public function __construct()
    {
        parent::__construct();
        $this->productService = new ProductService();
    }

    public function getProducts() {
        $category = $this->request->getBody()['category'];
        $pageNo = $this->request->getBody()['pageNo'];
        $pageSize = $this->request->getBody()['pageSize'];
        $products = $this->productService->getProductsByCondition($category, $pageNo, $pageSize);
        $this->response->sendJson($products);
    }
    public function getDetailedProduct(){
        $id = $this->request->getBody()['product-id'];
        $product = $this->productService->getProductById($id);
        $this->response->sendJson($product);
    }
}