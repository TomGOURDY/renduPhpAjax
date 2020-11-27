<?php
namespace App\Controller;

use App\Model\UserModel;

class UserController{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }
    
    private static function createSession($username, $email, $password) {
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
    }

    public function inscription()
    {
        $signupIsSuccessful = false;

        if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        
            // Récupérer les infos de $_POST et les "sécuriser" en utilisant htmlspecialchars
            $username = htmlspecialchars($_POST["username"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);

            //Verify that the email is valid
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                //Vérifier si un utilisateur n'utilise pas déjà l'email ou le pseudo
                $sameEmail = $this->model->SelectUserFromEmail($email);
                $sameUsername = $this->model->SelectUserFromUsername($username);
    
                if (empty($sameEmail) && empty($sameUsername)) {
                    $requestWorked = $this->model->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)", array(':username' => $username, ':email' => $email, ':password' => password_hash($password, PASSWORD_DEFAULT)));

                    //Start session of user
                    UserController::createSession($username, $email, $password);

                    //Change status of user to active
                    $this->model->prepare("UPDATE user SET isActive=1 WHERE email='$email'");

                    $signupIsSuccessful = true;

                } else if(!empty($sameEmail)) {
                    //Afficher erreur que l'email est déjà utilisé
                } else {
                    //Afficher erreur que le pseudo est déjà utilisé
                }
            }
        }

        return $signupIsSuccessful;
    }

    public function connexion()
    {
        $signinIsSuccessful = false;

        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);

            // $model = new UserModel();
            // SELECT
            //$model->selectUser();
            $userData = $this->model->selectUserFromEmail($email);
            // vérifier password
            if($userData->email == $email && password_verify($password, $userData->password)) {
                //Start session of user
                UserController::createSession($userData["username"], $userData["email"], $userData["password"]);

                //Change status of user to active
                $this->model->prepare("UPDATE user SET isActive=1 WHERE email='$email'");

                $signinIsSuccessful = true;
            } else {
                //Redirect user to form
                // header("index.php?page=accueil");
                // exit;
            }
            // true => header
            // false => formulaire
        } else {
            // require ConnexionView
            // require ROOT."App/View/connexionView.php";

            //Redirect user to form
            // header("index.php?page=connexion");
            // exit;
        }

        return $signinIsSuccessful;
    }

}