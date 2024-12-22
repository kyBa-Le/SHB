<?php
namespace app\model;

use app\core\Application;
use app\core\Model;
class OrderItemModel extends Model {
    protected $table = 'order_items';

    public function getOrderItemsByUserId($userId){
        $sql = "select * from $this->table where user_id = $userId";
        return $this->queryManyRows($sql);
    }

    public function getOrderItemById($id){
        $sql = "select * from $this->table where id = $id";
        return $this->queryOneRow($sql);
    }
}