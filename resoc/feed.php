<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Flux</title>         
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
        <div id="wrapper">
            <?php
            /**
             * Cette page est TRES similaire à wall.php. 
             * Vous avez sensiblement à y faire la meme chose.
             * Il y a un seul point qui change c'est la requete sql.
             */
            /**
             * Etape 1: Le mur concerne un utilisateur en particulier
             */
            ?>
            <?php
            /**
             * Etape 2: se connecter à la base de donnée
             */
            include 'connexionSQL.php';
            include 'tagslist.php';
            include 'requests.php'; 
            // $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
            ?>

            <aside>
                <?php
                /**
                 * Etape 3: récupérer le nom de l'utilisateur
                 */
                $folderName = "feedUsers"; 
                $laQuestionEnSql = request($folderName); 
                $lesInformations = connexion($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
                //echo "<pre>" . print_r($user, 1) . "</pre>";
                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message des utilisatrices
                        auxquel est abonnée l'utilisatrice <?php echo $user['alias']?>
                        (n° <?php echo $userId ?>)
                    </p>

                </section>
            </aside>
            <main>
                <?php
                /**
                 * Etape 3: récupérer tous les messages des abonnements
                 */
                $folderName = "feedPosts"; 
                 $laQuestionEnSql = request($folderName); 
                $lesInformations = connexion($laQuestionEnSql);
                // if ( ! $lesInformations)
                // {
                //     echo("Échec de la requete : " . $mysqli->error);
                // }

                /**
                 * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
                 * A vous de retrouver comment faire la boucle while de parcours...
                 */
                while ($post = $lesInformations->fetch_assoc())
                {
                    $tags = explode(',', $post['taglist']);
                   // echo "<pre>" . print_r($post, 1) . "</pre>";
                    ?>                
                    <article>
                        <h3>
                            <time ><?php echo $post['created'] ?></time>
                        </h3>
                        <address><?php echo $post['author_name']?></address>
                        <div>
                            <p><?php echo $post['content']?></p>
                        </div>                                            
                        <footer>
                            <small>♥ <?php echo $post['like_number']?></small>
                           
                            <?php 
                            displayTags($tags);
                            ?>
                        </footer>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
