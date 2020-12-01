<?php
    namespace App\Model;
    use Core\Database;

    class FriendModel extends Database {
        private $userID;

        public function __construct($userID)
        {
            $this->userID = $userID;
            parent::__construct();
        }

        public function getUserID() {
            return $this->userID;
        }
    }