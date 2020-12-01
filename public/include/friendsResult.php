<?php
    session_start();
    require "../../Autoloader.php";
    Autoloader::register();
    use \App\Controller\FriendController;

    $friendController = new FriendController($_SESSION['id']);
    $friendList = null;

    //Get the friends list
    if (isset($_POST) && array_key_exists('search', $_POST)) {
        $friendList = $friendController->getUserList($_POST['search']);
    }

    foreach ($friendList as $friend) {
        $connection = "";
        $friend->isActive == 0 ? $connection = "disconnected" : $connection = "connected";

        echo '<article class="friend">';
        echo "<p class=\"friend-username $connection\">$friend->username</p>";
        echo '<hr class="horizontal-guide">';
        echo "<button class=\"removeFriend fas fa-users-slash\" value=\"$friend->user_id\"></button>";
        echo '</article>';
    }