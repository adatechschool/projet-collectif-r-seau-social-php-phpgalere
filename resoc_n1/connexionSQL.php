<?php 
function request($laQuestionEnSql) {
    $mysqli = new mysqli("localhost", "root", "root", "socialnetwork"); 
    if ($mysqli->connect_errno)
    {
        echo(print_r("<article>", 1));
        echo(print_r("Échec de la connexion : " . $mysqli->connect_error, 1));
        echo(print_r("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>", 1));
        echo(print_r("</article>", 1));
        exit();
    }
    $lesInformations = $mysqli->query($laQuestionEnSql);
    return $lesInformations;
}
?>