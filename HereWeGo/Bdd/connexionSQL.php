<?php
try {
    // On se connecte à MySQL
    //Attention Etienne est connecté en 3307 si Christophe l'utilise changer le code en 3306
    $dsn = 'mysql:host=localhost;dbname=HereWeGo;charset=utf8;port=3307'; //'mysql:host=mysql.etu.umontpellier.fr;dbname=e20220000271;charset=UTF8'
    $username = 'root'; //'e20220000271'
    $password = 'root'; //'Emma16'
    $db = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}
?>