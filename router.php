<?php
use App\Controller\FriendController;
use App\Controller\UserController;
use App\Controller\PollController;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && array_key_exists("action", $_POST)) {
    switch($_POST["action"]) {
        case "deconnect":
            //Deconnect user
            $controller = new UserController();
            $controller->deconnect();

            //Redirect to homepage
            header("Location: index.php?page=accueil");
            exit;
            break;
        case 'connect':
            //Connect user
            $controller = new UserController();
            $success = $controller->connexion();

            //Redirect depending of the success of the connection
            if ($success) {
                header("Location: index.php?page=accueil");
                exit;
            } else {
                header("Location: index.php?page=connexion");
                exit;
            }
            break;
        case 'signup':
            //Sign the new user up
            $controller = new UserController();
            $success = $controller->inscription();

            //Redirect depending of the success of the signing up
            if ($success) {
                header("Location: index.php?page=accueil");
                exit;
            } else {
                header("Location: index.php?page=inscription");
                exit;
            }
            break;
        case 'sendpoll':
                //Send the new poll in the database
                $controller = new PollController();
                $success = $controller->newPoll();
    
                //Redirect depending of the success of the signing up
                if ($success) {
                    header("Location: index.php?page=sondagesuccess");
                    exit;
                } else {
                    header("Location: index.php?page=creasondage");
                    exit;
                }
                break;
        case 'addFriend':
            session_start();
            require_once("./Autoloader.php");
            Autoloader::register();
            $controller = new FriendController($_SESSION['id']);
            $controller->addFriend($_POST['friendID']);
            break;
        case 'removeFriend':
            session_start();
            require_once("./Autoloader.php");
            Autoloader::register();
            $controller = new FriendController($_SESSION['id']);
            $controller->removeFriend($_POST['friendID']);
            break;
    }
} else if (array_key_exists("page", $_GET)) {
    switch ($_GET["page"]) {
        case 'accueil':
            require ROOT."/App/View/AccueilView.php";
        break;
        case 'connexion':
            require ROOT."/App/View/ConnexionView.php";
            break;
        case 'inscription':
            require ROOT."/App/View/InscriptionView.php";
            break;
        case 'amis':
            require ROOT."/App/View/FriendsView.php";
            break;
        case 'creasondage':
            require ROOT."/App/View/NewPollView.php";
            break;
    }
} else {
    require ROOT."/App/View/AccueilView.php"; //Default page
}