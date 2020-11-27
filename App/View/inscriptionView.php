<?php App\Controller\UserController::redirect(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form id="signInForm" action="index.php" method="post">
        <label for="username">Pseudo</label><br>
        <input type="text" id="username" name="username"><br>

        <label for="email">Email</label><br>
        <input type="text" id="email" name="email"><br>

        <label for="password">Mot de passe</label><br>
        <input type="text" id="password" name="password"><br>

        <button type="submit" name="action" value="signup">Inscription</button>
    </form>
</body>
</html>