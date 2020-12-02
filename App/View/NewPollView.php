<?php use App\Controller\PollController; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un nouveau sondage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include "./include/header.php"; ?>
    <main>
        <form id="newPoll" action="index.php" method="POST">
            <label for="question_sondage">Question:</label><br/>
            <input type="text" placeholder="Votre question" id="question_sondage" name="question_sondage" value="<?= PollController::fieldvalue("fields", 'question'); ?>"><br/>
            <div class='errorMessage'><?= PollController::fieldvalue("errors", 'questionError'); ?></div>

            <label for="reponse_sondage1">Réponse 1:</label><br/>
            <input type="text" placeholder="Réponse 1" id="reponse_sondage1" name="reponse_sondage1" value="<?= PollController::fieldvalue("fields", 'reponse1'); ?>"><br/>
            <label for="is-correct_1">Cette réponse est correcte:</label>
            <input type="radio" name="is-correct" id="is-correct-1" value="is_correct_1" checked><br/>
            <div class='errorMessage'><?= PollController::fieldvalue("errors", 'reponse1Error'); ?></div>

            <label for="reponse_sondage2">Réponse 2:</label><br/>
            <input type="text" placeholder="Réponse 2" id="reponse_sondage2" name="reponse_sondage2" value="<?= PollController::fieldvalue("fields", 'reponse2'); ?>"><br/>
            <label for="is-correct-2">Cette réponse est correcte:</label>
            <input type="radio" name="is-correct" id="is-correct-2" value="is_correct_2"><br/>
            <div class='errorMessage'><?= PollController::fieldvalue("errors", 'reponse2Error'); ?></div>

            <label for="sondage_deadline"></label><br/>
            <input type="datetime-local" id="sondage_deadline" name="sondage_deadline" value="<?= PollController::fieldvalue("fields", 'deadline'); ?>"><br/>
            <div class='errorMessage'><?= PollController::fieldvalue("errors", 'deadlineError'); ?></div>

            <button type="submit" name="action" value="sendpoll">Envoyer le sondage</button>
        </form>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>
</body>
</html>