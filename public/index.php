<?php
//Démarre une session de sauvegarde de données.
session_start();
if (!isset($_SESSION["loggedin"])) {
    $_SESSION["loggedin"] = false;
}

define("ROOT", dirname(__DIR__));
require ROOT."/Autoloader.php";

Autoloader::register();

require ROOT."/router.php";