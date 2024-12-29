<?php

namespace app\models;

use app\core\Model;

class PaymentsModel extends Model
{
    protected $table='payments';

    public function createPayment($dateTime, $total_cost, $description, $method, $province, $district, $detailed_address, $status, $id, $phone, $fullName) {
        $sql = "INSERT INTO $this->table (`dateTime`, `total_cost`, `description`, `method`, `province`, `district`, `detailed_address`, `status`, `phone`,`fullName`, `user_id`)
                VALUES ('$dateTime', $total_cost, '$description', '$method', '$province', '$district', '$detailed_address', '$status', '$fullName', '$phone', $id )";
        return $this->excuteSql($sql);
    }

    public function getPaymentByTimeUserId($dateTime, $userId) {
        $sql = "SELECT * FROM $this->table WHERE dateTime = '$dateTime' AND user_id = $userId";
        return $this->queryOneRow($sql);
    }
}