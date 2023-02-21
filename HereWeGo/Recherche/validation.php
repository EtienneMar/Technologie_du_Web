<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styleRecherche.css" />
    <title>Validation</title>
</head>

<body>
    <?php
    include("../Bdd/connexionSQL.php");
    //Requete SQL pour changer le nombre de place (décrémentation)
    $requestNbPlace = "UPDATE covoiturages SET nbPlaces = nbPlaces - 1 WHERE covoiturages.idCovoiturage =" . $_GET['idCovoiturageChoisi'];
    //echo $requestNbPlace;
//Requete SQL pour ajouter l'email de la personne qui réserve une place:
    $requestAddMail = "INSERT INTO transports (idTransport, idCovoiturage, email) VALUES (NULL, '" . $_GET['idCovoiturageChoisi'] . "', '" . $_SESSION['USER_MAIL'] . "')";
    //echo $requestAddMail;
    
    $sqlStatementPlace = $db->query($requestNbPlace);
    $sqlStatementPlace = $db->query($requestAddMail);

    //Pour afficher le trajet qui a été valider par l'utilisateur:
    $requestTrajetValid = "SELECT dates, villeDepart, villeArrivee, prixRecommande from trajets , covoiturages
where ( covoiturages.idTrajet = trajets.idTrajet) AND (covoiturages.idCovoiturage =" . $_GET['idCovoiturageChoisi'] . ")";
    //echo $requestTrajetValid;
//problème dans la requete...a verifier
    $trajetStatement = $db->prepare($requestTrajetValid);
    $trajetStatement->execute();
    $trajetReserve = $trajetStatement->fetch();
    //var_dump($trajetReserve)
    
    ?>

    <header>
        <?php include('../Header/header.php'); ?>
    </header>

    <section class='bandeauBleu'>
        <img class="voiture" src="../Images/Voiture.png" />
        <div class='recap'>
            <div>
                <?php
                echo "Ville de départ : " . $trajetReserve['villeDepart'] . "</br>";
                echo "Ville de destinantion : " . $trajetReserve['villeArrivee'] . "</br>";
                echo "Date du tajet : " . $trajetReserve['dates'] . "</br>";
                echo "Prix : " . $trajetReserve['prixRecommande'] . "</br>";
                ?>
            </div>
            <div>
                Votre voyage a bien été réservé!!!!</br>
                Nous vous souhaitons un bon voyage....
            </div>
        </div>
    </section>

    <?php include('../Footer/footer.html'); ?>

</body>

</html>

<!--Modification de la table idCovoiturage
Requete pour décrémenter le nombre de places en fonction de l'idCovoiturage:
    UPDATE covoiturages SET nbPlaces = nbPlaces - 1 WHERE covoiturages.idCovoiturage = 1;
Modification de la table transport pour ajouter l'adresse mail avec idTransport + idCovoiturage + email

$requestNbPlace="UPDATE covoiturages SET nbPlaces = nbPlaces - 1 WHERE covoiturages.idCovoiturage =".$_GET['idCovoiturageChoisi'];

$requestNbPlace="SELECT idCovoiturage, villeDepart,villeArrivee,prixRecommande, nbPlaces, dates FROM trajets, covoiturages 
    WHERE ((covoiturages.idTrajet=trajets.idTrajet) and villeDepart='".$vDepart."' and villeArrivee='".$vArrivee."' and dates =".$date.")";
-->