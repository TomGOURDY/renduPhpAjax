<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tchat en Ajax</title>
</head>

<!DOCTYPE html>
<html>
    <head>
	<title>Le tchat en AJAX !</title>
    </head>
	
    <body>
        <div id="messages">
            <!-- les messages du tchat -->

            <?php

                // on se connecte à notre base de données
                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=chat_ajax', 'root', '');
                }
                catch (Exception $e)
                {
                    die('Erreur : ' . $e->getMessage());
                }

                // on récupère les 10 derniers messages postés
                $requete = $bdd->query('SELECT * FROM messages ORDER BY id DESC LIMIT 0,10');

                while($donnees = $requete->fetch()){
                    // on affiche le message (l'id servira plus tard)
                    echo "<p id=\"" . $donnees['id'] . "\">" . $donnees['pseudo'] . " dit : " . $donnees['message'] . "</p>";
                }

                $requete->closeCursor();

            ?>

        </div>

	<form method="POST" action="traitement.php">
	    Pseudo : <input type="text" name="pseudo" id="pseudo" /><br />
	    Message : <textarea name="message" id="message"></textarea><br />
	    <input type="submit" name="submit" value="Envoyez votre message !" id="envoi" />
	</form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

      <script src="chat.js"></script>
    </body>
</html>


</html>