<?php
namespace App\Model;

use Core\Database;

class UserModel extends Database{
    public function SelectUser($email) {
        return $this->query("SELECT * FROM user WHERE email='$email'", true);
    }

}