<?php
use App\Controller\UserController;

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
    }
} else if (array_key_exists("page", $_GET)) {
    switch ($_GET["page"]) {
        case 'accueil':
            require ROOT."/App/View/accueilView.php";
        break;
        case 'connexion':
            require ROOT."/App/View/connexionView.php";
            break;
        case 'inscription':
            require ROOT."/App/View/inscriptionView.php";
            break;
        case 'amis':
            require ROOT."/App/View/friendsView.php";
            break;
    }
} else {
    require ROOT."/App/View/accueilView.php"; //Default page
}