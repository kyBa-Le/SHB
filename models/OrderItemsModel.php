<?php
namespace app\models;

use app\core\Model;
class OrderItemsModel extends Model {
    protected $table = 'order_items';

    public function getOrderItemsByUserId($userId){
        $sql = "select * from $this->table where user_id = $userId";
        return $this->queryManyRows($sql);
    }

    public function updateOrderItemQuantity($id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = $quantity WHERE id = $id ";
        return $this->excuteSql($sql);
    }

    public function deleteOrderItemById($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        return $this->excuteSql($sql);
    }

    public function getOrderItemById($id) 
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        return $this->queryOneRow($sql);
    }

    public function createNewOrderItem($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor, $paymentId, $userId, $status){
        $sql = "INSERT INTO $this->table (product_name, quantity, unit_price, size, product_id, product_image_link, product_color, payments_id, user_id, status) 
               VALUES ('$productName', $quantity, $unitPrice, '$size', $productId, '$productImageLink', '$productColor', $paymentId, $userId, '$status')";
        return $this->excuteSql($sql);
    }

    public function getExistingOrderItem($userId, $size, $productId,  $productColor) {
        $sql = "SELECT * FROM $this->table 
            WHERE user_id = $userId AND size ='$size' AND product_id = $productId AND product_color = '$productColor' AND status = 'Pending'";
        return $this->queryOneRow($sql);
    }

    public function updateOrderItem($paymentId, $status, $orderItem_id) {
        $sql = "UPDATE $this->table SET status = '$status', payments_id = $paymentId 
                WHERE id = $orderItem_id;";
        return $this->excuteSql($sql);
    }

    public function getTotalOrderItemQuantityByMonthAndYear($month, $year) {
        $sql = "SELECT SUM(quantity) as total FROM $this->table JOIN payments ON payments_id = payments.id WHERE MONTH(datetime) = $month AND YEAR(datetime) = $year AND $this->table.status != 'Pending'";
        return $this->queryOneRow($sql);
    }
}