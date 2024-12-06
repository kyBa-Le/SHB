<?php

namespace app\core;

use PDO;

class Model
{
    protected $table;
    protected static $db;
    public function __construct(){
        self::$db = Application::$database;
    }

    public function getAll() {
        $sql = "SELECT * FROM ". $this->table;
        $results = self::$db->query($sql);
        $data = [];
        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function getById($id) {
        $sql = "SELECT * FROM ". $this->table." WHERE id = :id";
        $result = self::$db->query($sql);
        return $result->fetch();
    }
}