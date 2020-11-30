<?php
    session_start();
    
    use App\Controller\FriendController;

    $friendController = new FriendController($_SESSION['id']);
    $friendList = null;

    //Get the friends list
    if (isset($_POST) && array_key_exists('search', $_POST)) {
        $friendList = $friendController->getFriendList($_POST['search']);
    } else {
        $friendList = $friendController->getFriendList();
    }

    /*
    <article class="friend">
        <p class="friend-username disconnected">Jane Doe</p>
        <hr class="horizontal-guide">
        <button class="removeFriend fas fa-users-slash" id="#"></button>
    </article>
    */
    // var_dump($friendList);
    foreach ($friendList as $key => $friend) {
        
    }