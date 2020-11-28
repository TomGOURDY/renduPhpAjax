<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include "./include/header.php"; ?>
    <main>
        <div class="content-container">
            <h1>Amis</h1>
            <section id="friends-list-container">
                <h2>Liste d'amis</h2>
                <form action="">
                    <input type="text" name="" id="" placeholder="Rechercher">
                </form>
                <section id="friends-list" class="data-wrapper">
                    <!-- placeholders -->
                    <article class="friend">
                        <p class="friend-username connected">John Doe</p>
                        <hr class="horizontal-guide">
                        <button class="removeFriend fas fa-users-slash" id="#"></button>
                    </article>
                    <article class="friend">
                        <p class="friend-username disconnected">Jane Doe</p>
                        <hr class="horizontal-guide">
                        <button class="removeFriend fas fa-users-slash" id="#"></button>
                    </article>
                </section>
            </section>
            <hr class="vertical-separator">
            <section id="friends-search-container">
                <h2>Ajouter des amis</h2>
                <form action="">
                    <input type="text" name="" id="" placeholder="Rechercher">
                </form>
                <section id="search-results"  class="data-wrapper">
                    <!-- placeholders -->
                    <article class="result">
                        <p class="friend-username">Lorem Ipsum 1</p>
                        <hr class="horizontal-guide">
                        <button class="addFriend fas fa-users"></button>
                    </article>
                    <article class="result">
                        <p class="friend-username">Lorem Ipsum 2</p>
                        <hr class="horizontal-guide">
                        <button class="addFriend fas fa-users"></button>
                    </article>
                    <article class="result">
                        <p class="friend-username">Lorem Ipsum 2</p>
                        <hr class="horizontal-guide">
                        <button class="addFriend fas fa-users"></button>
                    </article>
                </section>
            </section>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>