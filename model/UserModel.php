<?php

namespace app\model;

use app\core\Model;

class UserModel extends Model
{
    public function getUserByEmail(mixed $email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = '$email'";
        $this->queryOneRow($sql);
    }
}