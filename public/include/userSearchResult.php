<?php
    session_start();
    require "../../Autoloader.php";
    Autoloader::register();
    use \App\Controller\FriendController;

    $friendController = new FriendController($_SESSION['id']);
    $userList = null;

    //Get the user list
    if (isset($_POST) && array_key_exists('search', $_POST)) {
        $userList = $friendController->getUserList($_POST['search'], false);
    }

    foreach ($userList as $user) {
        echo '<article class="result">';
        echo "<p>$user->username</p>";
        echo '<hr class="horizontal-guide">';
        echo "<button class=\"addFriend fas fa-users\" value=\"$user->user_id\"></button>";
        echo '</article>';
    }