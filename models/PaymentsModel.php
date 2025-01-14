<?php

namespace app\models;

use app\core\Model;

class PaymentsModel extends Model
{
    protected $table='payments';

    public function createPayment($dateTime, $total_cost, $description, $method, $province, $district, $detailed_address, $status, $id, $phone, $fullName) {
        $sql = "INSERT INTO $this->table (`dateTime`, `total_cost`, `description`, `method`, `province`, `district`, `detailed_address`, `status`, `phone`,`fullName`, `user_id`)
                VALUES ('$dateTime', $total_cost, '$description', '$method', '$province', '$district', '$detailed_address', '$status', '$phone', '$fullName', $id )";
        return $this->excuteSql($sql);
    }

    public function getPaymentByTimeUserId($dateTime, $userId) {
        $sql = "SELECT * FROM $this->table WHERE dateTime = '$dateTime' AND user_id = $userId";
        return $this->queryOneRow($sql);
    }

    public function getTotalPaymentByMonthAndYear($month, $year) {
        $sql = "SELECT COUNT(*) AS total FROM $this->table WHERE MONTH(datetime) = $month AND YEAR(datetime) = $year";
        return $this->queryOneRow($sql);
    }

    public function getTotalIncomeByMonthAndYear ($month, $year) {
        $sql = "SELECT SUM(total_cost) AS total FROM $this->table WHERE MONTH(datetime) = $month AND YEAR(datetime) = $year";
        return $this->queryOneRow($sql);
    }

    public function getOrdersInLast15Days() {
        $sql = "SELECT COUNT(*) AS total, DATE(dateTime) AS dateOnly 
                FROM $this->table 
                WHERE DATE(dateTime) >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)
                GROUP BY DATE(dateTime)";
        return $this->queryManyRows($sql);
    }
}