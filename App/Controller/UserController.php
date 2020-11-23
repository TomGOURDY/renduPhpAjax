<?php
namespace App\Controller;

use App\Model\UserModel;

class UserController{
    public function __construct()
    {
        $model = new UserModel();
    }
    
    private static function createSession($id, $username, $email, $password) {
        session_start();
        $_SESSION["user_id"] = $id;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
    }

    public function inscription()
    {
        // Récupérer les infos de $_POST
        // Avant de stocker il faut utiliser sur chaque infos htmlspecialchars()
        // "<script> alert('coucou') </script>";
        

    }

    public function connexion()
    {
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);

            // $model = new UserModel();
            // SELECT
            //$model->selectUser();
            $userData = $this->model->selectUser($email);
            // vérifier password
            if($userData->email == $email && password_verify($password, $userData->password)) {
                //Start session of user
                UserController::createSession($userData["user_id"], $userData["username"], $userData["email"], $userData["password"]);

                //Change status of 

                //Redirect user to homepage
                header("index.php?page=accueil");
                exit;
            } else {
                //Redirect user to form
                header("index.php?page=accueil");
                exit;
            }
            // true => header
            // false => formulaire
        } else {
            // require ConnexionView
            require ROOT."App/View/connexionView.php";
        }
    }

}