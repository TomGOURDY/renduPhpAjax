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

if(isset($_POST['submit'])){ // si on a envoyé des données avec le formulaire

    if(!empty($_POST['pseudo']) AND !empty($_POST['message'])){ // si les variables ne sont pas vides
    
        $pseudo = mysql_real_escape_string($_POST['pseudo']);
        $message = mysql_real_escape_string($_POST['message']); // on sécurise nos données

        // puis on entre les données en base de données :
        $insertion = $bdd->prepare('INSERT INTO messages VALUES("", :pseudo, :message)');
        $insertion->execute(array(
            'pseudo' => $pseudo,
            'message' => $message
        ));

    }
    else{
        echo "Vous avez oublié de remplir un des champs !";
    }

}

?>



<?php

// ...
// on se connecte à notre base de données

if(!empty($_GET['id'])){ // on vérifie que l'id est bien présent et pas vide

    $id = (int) $_GET['id']; // on s'assure que c'est un nombre entier

    // on récupère les messages ayant un id plus grand que celui donné
    $requete = $bdd->prepare('SELECT * FROM messages WHERE id > :id ORDER BY id DESC');
    $requete->execute(array("id" => $id));

    $messages = null;

    // on inscrit tous les nouveaux messages dans une variable
    while($donnees = $requete->fetch()){
        $messages .= "<p id=\"" . $donnees['id'] . "\">" . $donnees['pseudo'] . " dit : " . $donnees['message'] . "</p>";
    }

    echo $messages; // enfin, on retourne les messages à notre script JS

}

?>




