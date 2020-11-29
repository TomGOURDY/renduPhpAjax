<?php
namespace App\Model;

use Core\Database;

class FriendModel extends Database {
    private $userID;

    public function __construct($userID)
    {
        $this->userID = $userID;
    }

    public function getUserID() {
        return $this->userID;
    }

    // public function getFriendList()
    // {
    //     return $this->query("SELECT user_id, username, isActive
    //     FROM user
    //     WHERE user_id IN (SELECT DISTINCT
    //         UF(user_id = '$this->userID', friend_id, user_id)
    //     FROM friendship
    //     WHERE status = 1 AND (user_id = '$this->userID' OR friend_id = '$this->userID'));");
    // }

    // private function isFriendWith($requestedUserID) {
    //     return $this->query("SELECT * FROM friendship WHERE (user_id='$this->userID' AND friend_id='$requestedUserID') OR (user_id='$requestedUserID' AND friend_id='$this->userID');", true) == false ? false : true;
    // }

    // public function addFriend($friendID) {
    //     if (!$this->isFriendWith($friendID)) {
    //         $this->prepare("INSERT INTO friendship(user_id, friend_id) VALUES(:userID, :friendID);", array(':userID' => $this->userID, ':friendID' => $friendID));

    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function removeFriend($friendID) {
    //     if ($this->isFriendWith($friendID)) {
    //         $this->prepare("DELETE FROM friendship WHERE (user_id='$this->userID' AND friend_id='$friendID') OR (user_id='$friendID' AND friend_id='$this->userID');");

    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}