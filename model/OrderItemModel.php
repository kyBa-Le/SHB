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
        $sql = "UPDATE $this->table SET quantity = $quantity WHERE id = $id and quantity = $quantity";
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

}