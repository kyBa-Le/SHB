<?php

namespace app\models;

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
        $sql = "SELECT * FROM $this->table WHERE email = '$email'";;
        return $this->queryOneRow($sql);
    }

    public function getUserByEmailAndPassword(mixed $email, string $password){
        $sql = "SELECT * FROM $this->table WHERE email = '$email' AND password = '$password'";
        return $this->queryOneRow($sql);
    }

    public function updateUserById($username, $fullName,  $phone,  $province, $district, $detailed_address, mixed $userID)
    {
        $sql = "UPDATE $this->table SET username = '$username', fullName = '$fullName', phone = '$phone', province = '$province', district = '$district', detailed_address = '$detailed_address'
                WHERE id = '$userID'";
        return Model::$db->query($sql);
    }

    public function getUserById(mixed $userID)
    {
        $sql = "SELECT * FROM $this->table WHERE id = '$userID'";
        return $this->queryOneRow($sql);
    }

    public function updatePasswordByEmail($email, $newPassword )
    {
        $sql = "UPDATE $this->table SET password = '$newPassword'
                WHERE email = '$email'";
        return Model::$db->query($sql);
    }
    
    public function changeAvatar($link, $userId) 
    {
        $sql = "UPDATE $this->table SET avatar_link = '$link' WHERE id = '$userId'";
        return Model::$db->query($sql);
    }
}