<?php use App\Controller\UserController;
      UserController::redirect(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Connexion</h1>
    <form id="loginForm" action="index.php" method="post">
        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" value="<?= UserController::fieldvalue("fields", 'email'); ?>"><br>
        <div class='errorMessage'><?= UserController::fieldvalue("errors", 'emailError'); ?></div>

        <label for="password">Mot de passe</label><br>
        <input type="text" id="password" name="password" value="<?= UserController::fieldvalue("fields", 'password'); ?>"><br>
        <div class='errorMessage'><?= UserController::fieldvalue("errors", 'passwordError'); ?></div>
        
        <button type="submit" name="action" value="connect">Connexion</button>
    </form>
</body>
</html>