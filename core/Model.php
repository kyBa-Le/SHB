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

    public function queryManyRows($sql)
    {
        $results = self::$db->query($sql);
        $data = [];
        while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function queryOneRow($sql) {
        $results = self::$db->query($sql);
        return $results->fetch();
    }

    public function excuteSql($sql) {
        return self::$db->query($sql);
    }

}