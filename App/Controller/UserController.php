<?php
namespace App\Controller;

use App\Model\UserModel;

class UserController{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }
    
    private static function createSession($loggedin = true) {
        $_SESSION["loggedin"] = $loggedin;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach($_POST as $inputName => $value) {
                $_SESSION['fields'][$inputName] = $value;
            }
        }
    }

    private static function saveErrors($errorArray) {
        foreach($errorArray as $errorName => $value) {
            $_SESSION['errors'][$errorName] = $value;
        }
    }

    public static function fieldvalue( $fields, $field=false ){
        return ( $field && !empty( $field ) && isset( $_SESSION[ $fields ] ) && array_key_exists( $field, $_SESSION[ $fields ] ) ) ? $_SESSION[ $fields ][ $field ] : '';
    }

    private static function endSession() {
        session_unset();
        $_SESSION["loggedin"] = false;
    }

    public function deconnect($email) {
        UserController::endSession();

        //Set status of user to offline in database
        $this->model->prepare("UPDATE user SET isActive=0 WHERE email='$email'");
    }

    private function connect($username, $email, $password) {
        UserController::createSession($username, $email, $password);

        //Change status of user to active
        $this->model->prepare("UPDATE user SET isActive=1 WHERE email='$email'");
    }

    public static function redirect() {
        if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['loggedin']) {
            header("Location: index.php?page=accueil");
            exit;
        }
    }

    public function inscription()
    {
        $signupIsSuccessful = false;

        // Get secured POST data 
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        //Vérification de la présence de toute les informations pour l'inscription
        if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
            //Verify that the email is valid
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                
                //Check if there is already a user with this email or username
                $sameEmail = $this->model->SelectUserFromEmail($email);
                $sameUsername = $this->model->SelectUserFromUsername($username);
    
                //If no one has the same email or username
                if (empty($sameEmail) && empty($sameUsername)) {
                    //Send the user data to the database
                    $this->model->prepare("INSERT INTO user(username, email, password) VALUES (:username, :email, :password)", array(':username' => $username, ':email' => $email, ':password' => password_hash($password, PASSWORD_DEFAULT)));

                    //Connect the user
                    $this->connect($username, $email, $password);

                    $signupIsSuccessful = true;
                } else if(!empty($sameEmail)) {
                    //Display an error saying that the email is already used
                    UserController::createSession(false);

                    UserController::saveErrors(array('usernameError' => "", 'emailError' => "Cette adresse email est déjà utilisée. Veuillez en renseigner une autre.", 'passwordError' => ""));
                } else {
                    //Display an error saying that the username is already used
                    UserController::createSession(false);

                    UserController::saveErrors(array('usernameError' => "Ce pseudo est déjà utilisé. Veuillez en renseigner un autre.", 'emailError' => "", 'passwordError' => ""));
                }
            } else {
                //Display an error saying that the email was wrongly formatted
                UserController::createSession(false);

                UserController::saveErrors(array('usernameError' => "", 'emailError' => "Veuillez renseigner une adresse email valide.", 'passwordError' => ""));
            }
        } else {
            //Display an error saying that a field is missing
            $emailError = $passwordError = $usernameError = '';

            UserController::createSession(false);

            if (empty($_POST["username"])) {
                $usernameError = "Veuillez renseigner votre nom d'utilisateur.";
            }
            if (empty($_POST["email"])) {
                $emailError = "Veuillez renseigner votre adresse email.";
            }
            if (empty($_POST["password"])) {
                $passwordError = "Veuillez renseigner votre mot de passe.";
            }
            UserController::saveErrors(array('usernameError' => $usernameError, 'emailError' => $emailError, 'passwordError' => $passwordError));
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

                //Connect the user
                $this->connect($userData->username, $userData->email, $userData->password);

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