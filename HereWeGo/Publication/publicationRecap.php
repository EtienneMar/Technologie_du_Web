<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylePublier.css" />
    <title>Recherche</title>
</head>

<body>
    <header>
        <?php include('../Header/header.php'); ?>
    </header>
    <section class='bandeauBleu'>
        <img class="voiture" src="../Images/Voiture.png" />
        <div class="publier">
            <p>
                Votre trajet a bien été enregistré.
            </p>
            <p>
                Récapitulatif de votre trajet enregistré :</br>
                <?php echo "Ville de départ : " . $_GET['vDepart'] . "</br>";
                echo "Ville de destination : " . $_GET['vArrivee'] . "</br>";
                echo "Date du co-voiturage : " . $_GET['date'] . "</br>";
                echo "Nombre de places proposés : " . $_GET['nombreDePlace'] . "</br>"; ?>
            </p>
        </div>
    </section>
    <?php include('../Footer/footer.html'); ?>