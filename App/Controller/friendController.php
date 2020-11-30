<?php
namespace App\Controller;
use App\Model\FriendModel;

class FriendController {
    private $model;

    public function __construct($userID) {
        $this->model = new FriendModel($userID);
    }

    public function getFriendList($searchTerm = "")
    {
        if ($searchTerm == "") {
            return $this->model->query("SELECT user_id, username, isActive FROM user WHERE user_id IN (SELECT DISTINCT IF(user_id = ".$this->model->getUserID().", friend_id, user_id) FROM friendship WHERE status = 1 AND (user_id = ".$this->model->getUserID()." OR friend_id = ".$this->model->getUserID()."));");
        } else {
            return $this->model->query("SELECT user_id, username, isActive FROM user WHERE user_id IN (SELECT DISTINCT IF(user_id = ".$this->model->getUserID().", friend_id, user_id) FROM friendship WHERE status = 1 AND (user_id = ".$this->model->getUserID()." OR friend_id = ".$this->model->getUserID().")) AND username LIKE '%$searchTerm%';");
        }
    }

    private function isFriendWith($requestedUserID) {
        return $this->model->query("SELECT * FROM friendship WHERE (user_id=".$this->model->getUserID()." AND friend_id='$requestedUserID') OR (user_id='$requestedUserID' AND friend_id=".$this->model->getUserID().");", true) == false ? false : true;
    }

    public function addFriend($friendID) {
        if (!$this->isFriendWith($friendID)) {
            $this->model->prepare("INSERT INTO friendship(user_id, friend_id) VALUES(:userID, :friendID);", array(':userID' => $this->model->getUserID(), ':friendID' => $friendID));

            return true;
        } else {
            return false;
        }
    }

    public function removeFriend($friendID) {
        if ($this->isFriendWith($friendID)) {
            $this->model->prepare("DELETE FROM friendship WHERE (user_id=".$this->model->getUserID()." AND friend_id='$friendID') OR (user_id='$friendID' AND friend_id=".$this->model->getUserID().");");

            return true;
        } else {
            return false;
        }
    }
}