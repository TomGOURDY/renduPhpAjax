<header class="main-header">
    <nav>
        <ul>
            <li><a href="index.php?page=accueil">Accueil</a></li>
            <li><a href="index.php?page=amis">Amis</a></li>
            <li><a href="index.php?page=sondage">Nouveau sondage</a></li>
            <?php if (session_status() == PHP_SESSION_ACTIVE && $_SESSION['loggedin']) { ?>
                <li>
                    <a href='index.php?page=profil'>Profil</a>
                    <hr>
                    <form action="index.php" method="post">
                        <button type="submit" name="action" value="deconnect">Déconnexion</button>
                    </form>
                </li>
            <?php } else { ?>
                <li class="offline-buttons">
                    <a href='index.php?page=connexion'>Connexion</a>
                    <hr>
                    <a href="index.php?page=inscription">Inscription</a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</header>