<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylePublier.css" />
    <title>Recherche</title>
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
    <script type="module" src="../Script/majVille.js"></script>
</head>

<body>
    <!--Recupérartion des trajets sur le Base de donnée-->
    <?php

    include('../Bdd/connexionSQL.php');
    $request = 'SELECT villeDepart,villeArrivee, prixRecommande FROM trajets';
    $trajetsStatement = $db->prepare($request);
    $trajetsStatement->execute();
    $trajets = $trajetsStatement->fetchAll();

    foreach ($trajets as $trajet)
        $departNonSorted[] = $trajet["villeDepart"];
    $departSorted = array_unique($departNonSorted);
    sort($departSorted); foreach ($trajets as $trajet)
        $arriveeNonSorted[] = $trajet["villeArrivee"];
    $arriveeSorted = array_unique($arriveeNonSorted);
    sort($arriveeSorted);

    ?>

    <!--Créer une condition pour indiquer le type de trajet-->
    <header>
        <?php include('../Header/header.php'); ?>
    </header>

    <section class='bandeauBleu'>
        <img class="voiture" src="../Images/Voiture.png" />
        <form action="./publicationRecap.php" method="get">
            <div class="publierBarre">
                <div class="publierBarre_select">
                    <select name="vDepart" class="publierBarre_select--villeDepart" id="vDepart">
                        <option class="publierBarre_select--villeDepart--option"> Départ </option>
                        <?php foreach ($departSorted as $item)
                            echo '<option class="publierBarre_select--villeDepart--option">' . $item . '</option>';
                        ?>
                    </select>
                    <button type="button" onclick="switchDestination(rotatePicture360)" id="rotateAction"
                        class="switchButton">
                        <img class="switchPicture" id="pictureToRotate" src="../Images/switch.png" />
                    </button>
                    <!--A prendre sur la table trajet-->
                    <!-- <label for="destination">Destination :</label></br> -->
                    <select name="vArrivee" class="publierBarre_select--villeArrivee" id="vArrivee">
                        <option class="publierBarre_select--villeArrivee--option"> Arrivée </option>
                        <?php foreach ($arriveeSorted as $item)
                            echo '<option class="publierBarre_select--villeArrivee--option">' . $item . '</option>';
                        ?>
                    </select>
                </div>

                <div class="publierBarre_input">
                    <!-- <label for="date">Date du voyage :</label></br> -->
                    <input type="date" class="publierBarre_input--calendrier" name="date" id="date"
                        value="<?php echo date('Y-m-d') ?>" ; required />
                    <!-- <label for="nombreDePlace">Nombre de places :</label></br> -->
                    <input type="number" class="publierBarre_input--number" name="nombreDePlace" value="1"
                        id="nombreDePlace" maxlength="1" max="7" min="1" required />
                </div>
            </div>
            <?php
            if (isset($_SESSION['USER_NAME'])) {
                echo '<button type="submit" class="btn">Publier</button>';
            } else {
                echo '<p class="sessionNotActive">Merci de bien vouloir vous connecter pour publier votre trajet.</p>';
            }
            ?>
        </form>
    </section>

    <?php
    if (isset($_GET["nombreDePlace"]) && (isset($_GET["date"]))) {
        $villeDepart = $_GET["vDepart"];
        $villeArrivee = $_GET["vArrivee"];
        $dateCovoit = $_GET["date"];
        $nombreDePlace = $_GET["nombreDePlace"];
        $email = $_SESSION['USER_MAIL'];

        //Récupération de l'id trajets
        $requestGetIdTrajet = "SELECT idTrajet FROM Trajets WHERE villeDepart='$villeDepart' AND villeArrivee='$villeArrivee'";
        $getIdTrajetRequestStatement = $db->prepare($requestGetIdTrajet);
        $getIdTrajetRequestStatement->execute();
        $idTrajetResultat = $getIdTrajetRequestStatement->fetch();
        $idTrajet = $idTrajetResultat['idTrajet'];

        $request = "INSERT INTO Covoiturages(idTrajet, dates, email, nbPlaces) VALUES ('$idTrajet', '$dateCovoit', '$email', '$nombreDePlace')";
        $insertIntoCovoiturageStatement = $db->prepare($request);
        $insertIntoCovoiturageStatement->execute();
    }
    ?>

    <?php include('../Footer/footer.html'); ?>

</body>
<script src="../Script/switchVille.js"></script>

</html>