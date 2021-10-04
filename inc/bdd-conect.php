<?php

$servername = '127.0.0.1:3306';
$username = 'root';
$password = 'root';

//On essaie de se connecter
try{
    $bdd = new PDO("mysql:host=$servername;dbname=teufBot", $username, $password);
    //On définit le mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<!-------------------------- Connexion bdd réussie -------------------------------->';
}

    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();

}
?>