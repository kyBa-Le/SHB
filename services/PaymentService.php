<?php

namespace app\services;

use app\models\PaymentsModel;

class PaymentService
{
    private $paymentModel;
    public function __construct()
    {
        $this->paymentModel = new PaymentsModel();
    }
    public function createPayment($dateTime, $total_cost, $description, $method, $province, $district, $detailed_address, $id, $phone, $fullName) {
        $total_cost = (int) $total_cost;
        $id = (int) $id;
        $status = ($method == 'COD') ? 'Pending' : 'Paid';
        return $this->paymentModel->createPayment($dateTime, $total_cost, $description, $method, $province, $district, $detailed_address, $status, $id, $phone, $fullName);
    }
    public function getPaymentByTimeUser($dateTime, $id) {
        $id = (int) $id;
        return $this->paymentModel->getPaymentByTimeUserId($dateTime, $id);
    }

    public function getTotalPaymentByMonthAndYear($month, $year) {
        return $this->paymentModel->getTotalPaymentByMonthAndYear($month, $year);
    }

    public function getTotalIncomeByMonthAndYear($month, $year) {
        return $this->paymentModel->getTotalIncomeByMonthAndYear($month, $year);
    }

    public function getOrdersInLast15Days() { 
        return $this->paymentModel->getOrdersInLast15Days();
    }
}