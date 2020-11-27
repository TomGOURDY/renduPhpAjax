<?php
define("ROOT", dirname(__DIR__));
require ROOT."/Autoloader.php";

//Démarre une session de sauvegarde de données.
Autoloader::register();

require ROOT."/router.php";