<?php

use App\Controller\UserController;

if (array_key_exists("page", $_GET)) {
    
    switch ($_GET["page"]) {
        case 'accueil':
            require ROOT."App/View/accueilView.php";
        break;
        case 'connexion':
            $controller = new UserController();
            
            if (array_key_exists("action", $_GET) && $_GET["page"] == 'login') {
                $controller->connexion();
            }
        break;
    }
} else {
    require ROOT."App/View/accueilView.php"; //Affichage de la page d'accueil par défaut
}