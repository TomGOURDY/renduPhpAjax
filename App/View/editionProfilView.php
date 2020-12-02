<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetgroupephp', 'root', '');

if (isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM users WHERE user_id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if (isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE user SET username = ? WHERE user_id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header('Location: index.php?user_id=' . $_SESSION['id']);
    }


    if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE user SET email = ? WHERE user_id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header('Location: index.php?user_id=' . $_SESSION['id']);
    }

    
    if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
        $mdp1 = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
        $mdp2 = password_hash($_POST['newmdp2'], PASSWORD_DEFAULT);
        if ($_POST['newmdp1'] == $_POST['newmdp2']) {
            $insertmdp = $bdd->prepare("UPDATE user SET password = ? WHERE user_id = ?");
            $insertmdp->execute(array($mdp1, $_SESSION['id']));
            header('Location: index.php?user_id=' . $_SESSION['id']);
        } else {
            $msg = "Vos deux mdp ne correspondent pas !";
        }
    }
?>

<!DOCTYPE html>

<html lang="fr">
   <head>
      <title>Edition profil</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div>
         <h2>Edition de mon profil</h2>
         <div>
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label>Mail :</label>
               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if (isset($msg)) {
        echo $msg;
    } ?>
         </div>
      </div>
   </body>
</html>
<?php
} //else {
    //echo ('test');
//}
?>

