<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Administration</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <img src="resoc.jpg" alt="Logo de notre réseau social"/>
            <nav id="menu">
                <a href="news.php">Actualités</a>
                <a href="wall.php?user_id=5">Mur</a>
                <a href="feed.php?user_id=5">Flux</a>
                <a href="tags.php?tag_id=1">Mots-clés</a>
            </nav>
            <nav id="user">
                <a href="#">Profil</a>
                <ul>
                    <li><a href="settings.php?user_id=5">Paramètres</a></li>
                    <li><a href="followers.php?user_id=5">Mes suiveurs</a></li>
                    <li><a href="subscriptions.php?user_id=5">Mes abonnements</a></li>
                </ul>
                
            </nav>
        </header>
        <?php
        /**
         * Etape 1: Ouvrir une connexion avec la base de donnée.
         */
        include 'connexionSQL.php';
        ?>
        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
                /*
                 * Etape 2 : trouver tous les mots clés
                 */
                $laQuestionEnSql = "
                SELECT tags.id AS tag_id, tags.label AS tag_label FROM `tags` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                /*
                 * Etape 3 : @todo : Afficher les mots clés en s'inspirant de ce qui a été fait dans news.php
                 * Attention à ne pas oublier de modifier tag_id=321 avec l'id du mot dans le lien
                 */
                while ($tag = $lesInformations->fetch_assoc())
                {
                    //echo "<pre>" . print_r($tag, 1) . "</pre>";
                    ?>
                    <article>
                        <h3>#<?php echo$tag['tag_label']?></h3>
                        <p>id:<?php echo$tag['tag_id']?></p>
                        <nav>
                            <a href="tags.php?tag_id=<?php echo$tag['tag_id']?>">Messages</a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php
                /*
                 * Etape 4 : trouver tous les mots clés
                 * PS: on note que la connexion $mysqli à la base a été faite, pas besoin de la refaire.
                 */
                $laQuestionEnSql = "
                SELECT users.id AS user_id, users.alias AS user_alias FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                /*
                 * Etape 5 : @todo : Afficher les utilisatrices en s'inspirant de ce qui a été fait dans news.php
                 * Attention à ne pas oublier de modifier dans le lien les "user_id=123" avec l'id de l'utilisatrice
                 */
                while ($tag = $lesInformations->fetch_assoc())
                {
                    //echo "<pre>" . print_r($tag, 1) . "</pre>";
                    ?>
                    <article>
                        <h3><?php echo$tag['user_alias']?></h3>
                        <p>id:<?php echo$tag['user_id']?></p>
                        <nav>
                            <a href="wall.php?user_id=<?php echo$tag['user_id']?>">Mur</a>
                            | <a href="feed.php?user_id=<?php echo$tag['user_id']?>">Flux</a>
                            | <a href="settings.php?user_id=<?php echo$tag['user_id']?>">Paramètres</a>
                            | <a href="followers.php?user_id=<?php echo$tag['user_id']?>">Suiveurs</a>
                            | <a href="subscriptions.php?user_id=<?php echo$tag['user_id']?>">Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
