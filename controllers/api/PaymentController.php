<?php

namespace app\controllers\api;

use app\services\PaymentService;

class PaymentController extends BaseController
{
    private $paymentService;
    public function __construct() {
        parent::__construct();
        $this->paymentService = new PaymentService();
    }
    public function createPayment() {
        $id = $_SESSION['user']['id'];
        $data = $this->request->getBody();
        $dateTime = date("Y-m-d H:i:s", time());
        $total_cost = $data['total_cost'];
        $description = $data['description'];
        $method = $data['method'];
        $province = $data['province'];
        $district = $data['district'];
        $detailed_address = $data['detailed_address'];
        $phone = $data['phone'];
        $fullName = $data['full_name'];
        $payment = null;
        $isPaid = $this->paymentService->createPayment($dateTime, $total_cost, $description, $method, $province, $district, $detailed_address, $id, $phone, $fullName);
        if ($isPaid !== false) {
            $payment = $this->paymentService->getPaymentByTimeUser($dateTime, $id);
        } else {
            $isPaid = false;
        }
        $this->response->sendJson([
            'payment' => $payment, 'isPaid' => $isPaid
        ]);
    }

    public function getTotalPaymentByMonthAndYear() {
        $data = $this->request->getBody();
        $month = $data['month'];
        $year = $data['year'];
        $total = $this->paymentService->getTotalPaymentByMonthAndYear($month, $year);
        $this->response->sendJson($total);
    }

    public function getTotalIncomeByMonthAndYear() {
        $data = $this->request->getBody();
        $month = $data['month'];
        $year = $data['year'];
        $total = $this->paymentService->getTotalIncomeByMonthAndYear($month, $year);
        $this->response->sendJson($total);
    }
}