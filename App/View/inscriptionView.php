<?php use App\Controller\UserController;
      UserController::redirect(false); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Inscription</h1>
    <form id="signInForm" action="index.php" method="post">
        <label for="username">Pseudo</label><br>
        <input type="text" id="username" name="username" value="<?= UserController::fieldvalue("fields", 'username'); ?>"><br>
        <div class='errorMessage'><?= UserController::fieldvalue("errors", 'usernameError'); ?></div>

        <label for="email">Email</label><br>
        <input type="text" id="email" name="email" value="<?= UserController::fieldvalue("fields", 'email'); ?>"><br>
        <div class='errorMessage'><?= UserController::fieldvalue("errors", 'emailError'); ?></div>

        <label for="password">Mot de passe</label><br>
        <input type="text" id="password" name="password" value="<?= UserController::fieldvalue("fields", 'password'); ?>"><br>
        <div class='errorMessage'><?= UserController::fieldvalue("errors", 'passwordError'); ?></div>

        <button type="submit" name="action" value="signup">Inscription</button>
    </form>
</body>
</html>