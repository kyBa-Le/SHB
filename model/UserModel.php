<?php

namespace app\model;

use app\core\Model;

class UserModel extends Model
{
    protected $table = 'users';

    public function saveUser($email, $username, $password, $fullName, $phone, $province, $district, $detailed_address ) {
        $sql = "INSERT INTO $this->table (`email`, `username`, `password`, `fullName`, `phone`, `avatar_link`, `province`, `district`, `detailed_address`)
                VALUES ('$email', '$username', '$password', '$fullName', '$phone', NULL, '$province', '$district', '$detailed_address')";
        return Model::$db->query($sql);
    }

    public function getUserByEmail(mixed $email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = '$email'";
        $this->queryOneRow($sql);
    }
}