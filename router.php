<?php

use App\Controller\UserController;

if (array_key_exists("page", $_GET)) {
    
    switch ($_GET["page"]) {
        case 'accueil':
            require ROOT."App/View/accueilView.php";
        break;
        case 'connexion':
            $controller = new UserController();
            require ROOT."/App/View/connexionView.php";
            
            if (array_key_exists("action", $_GET) && $_GET["action"] == 'login') {
                $success = $controller->connexion();
                if ($success) {
                    header("index.php?page=accueil");
                    exit;
                } else {
                    header("index.php?page=connexion");
                    exit;
                }
            }
        break;
        case 'inscription':
            $controller = new UserController();
            require ROOT."/App/View/inscriptionView.php";
            
            if (array_key_exists("action", $_GET) && $_GET["action"] == 'signup') {
                $success = $controller->inscription();
                if ($success) {
                    header("index.php?page=accueil");
                    exit;
                } else {
                    header("index.php?page=inscription");
                    exit;
                }
            }
        break;
    }
} else {
    require ROOT."/App/View/accueilView.php"; //Affichage de la page d'accueil par défaut
}