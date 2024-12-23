<?php

namespace app\controllers\api;

use app\models\ProductColorsModel;
use app\services\ProductColorService;

class ProductColorController extends BaseController
{
    private $productColorService;

    public function __construct() {
        parent::__construct();
        $this->productColorService = new ProductColorService();
    }

    public function getColors() {
        $productId = $this->request->getBody()['product-id'];
        $productColors = $this->productColorService->getProductColorsByProductId($productId);
        $this->response->sendJson($productColors);
    }

}