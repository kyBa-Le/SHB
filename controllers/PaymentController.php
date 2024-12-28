<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\services\OrderItemService;
use app\services\PaymentService;
use app\services\paymentService\MomoService;

class PaymentController extends Controller {
    private $orderItemService;
    private $paymentService;

    public function __construct() {
        $this->orderItemService = new OrderItemService();
        $this->paymentService = new PaymentService();
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

    public function momoPayment() {
        $momoService = new MomoService();
        $data = Application::$app->request->getBody();
        $momoService->onlineCheckOut($data);
    }

    public function handleMomoCallback() {
        $paymentStatus = $_GET['resultCode'];
        $data = $_SESSION['data_payment'];

        if ($paymentStatus == 0) {
            $id = $_SESSION['user']['id'];
            $dateTime = date("Y-m-d H:i:s", time());
            $total_cost = $data['total_cost'];
            $description = $data['description'];
            $method = $data['method'];
            $province = $data['province'];
            $district = $data['district'];
            $detailed_address = $data['detailed_address'];
            $phone = $data['phone'];
            $fullName = $data['full_name'];
            $this->paymentService->createPayment($dateTime, $total_cost, $description, $method, $province, $district, $detailed_address, $id, $phone, $fullName);
            $payment = $this->paymentService->getPaymentByTimeUser($dateTime, $id);
            header('Location: /payment?paymentId=' . $payment['id']);
            exit();
        } else {
            // Xử lý trường hợp thanh toán thất bại
            header('Location: /payment?error=payment_failed');
            exit();
        }
    }
}
?>