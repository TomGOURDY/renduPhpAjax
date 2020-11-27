<?php
namespace App\Model;

use Core\Database;

class UserModel extends Database{
    public function SelectUserFromEmail($email) {
        return $this->query("SELECT * FROM user WHERE email='" . $email . "'", true);
    }
    public function SelectUserFromUsername($pseudo) {
        return $this->query("SELECT * FROM user WHERE username='" . $pseudo . "'", true);
    }

}