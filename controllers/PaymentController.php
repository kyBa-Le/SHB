<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\services\OrderItemService;
class PaymentController extends Controller {
    private $orderItemService;
    public function __construct() {
        $this->orderItemService = new OrderItemService();
    }
    
    public function show() {
        // Lấy dữ liệu từ POST
        $data = Application::$app->request->getBody(); 
        $orderItems = [];
        if (isset($data['ids'])) {
            $jsonString = trim($_POST['ids']); 
            $arr = json_decode($jsonString, true);
            if (is_array($arr)) {
                foreach ($arr as $id) {
                    $orderItems[] = $this->orderItemService->getOrderItemById($id);
                }
                $totalPrice = $this->totalPrice($orderItems);
            } else {
                echo "Dữ liệu không phải là mảng hợp lệ.";
                $orderItems = [];
            }
        }else {
            $orderItems = $data;
            $totalPrice = (int) $orderItems['unit_price'] * (int) $orderItems['quantity'];
        }
       
        return $this->render('payment', ['orderItems' => $orderItems, 'totalPrice' => $totalPrice]);
    }
    
    
    private function totalPrice($array) {
        $totalPrice = 0;
        for ($i = 0; $i<count($array); $i++) {
            $totalPrice += (int) $array[$i]['quantity'] * (int) $array[$i]['unit_price'];
        }
        return $totalPrice;
    }
}
?>