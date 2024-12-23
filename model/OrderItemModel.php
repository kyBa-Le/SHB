<?php
namespace app\model;

use app\core\Model;
class OrderItemModel extends Model {
    protected $table = 'order_items';

    public function getOrderItemsByUserId($userId){
        $sql = "select * from $this->table where user_id = $userId";
        return $this->queryManyRows($sql);
    }

    public function updateOrderItemQuantity($id, $quantity)
    {
        $sql = "UPDATE $this->table SET quantity = $quantity WHERE id = $id ";
        return Model::$db->query($sql);
    }

    public function deleteOrderItemById($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        return Model::$db->query($sql);
    }

    public function getOrderItemById($id) 
    {
        $sql = "SELECT * FROM $this->table WHERE id = $id";
        return $this->queryOneRow($sql);
    }

    public function addToCart($productName, $quantity, $unitPrice, $size, $productId, $productImageLink, $productColor,  $userId){
        $sql = "INSERT INTO $this->table (product_name, quantity, unit_price, size, product_id, product_image_link, product_color, payments_id, user_id, status) 
               VALUES ('$productName', $quantity, $unitPrice, '$size', $productId, '$productImageLink', '$productColor', NULL, $userId, 'Pending')";
        return Model::$db->query($sql);
    }

    public function getExistingOrderItem($userId, $size, $productId,  $productColor) {
        $sql = "SELECT * FROM $this->table 
            WHERE user_id = $userId AND size ='$size' AND product_id = $productId AND product_color = '$productColor'";
        return $this->queryOneRow($sql);
    }
}