<?php
define("ROOT", dirname(__DIR__));
require ROOT."/Autoloader.php";

//Démarre une session de sauvegarde de données.
session_start();
Autoloader::register();

require ROOT."/router.php";