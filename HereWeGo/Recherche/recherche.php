<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styleRecherche.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
    <script type="module" src="../Script/majVille.js"></script>
    <title>Recherche</title>
</head>

<body>
    <!--Recupérartion des trajets sur le Base de donnée-->
    <?php
include('../Bdd/connexionSQL.php');
$request = 'SELECT villeDepart,villeArrivee, prixRecommande FROM trajets';
$trajetsStatement = $db->prepare($request);
$trajetsStatement->execute();
$trajets = $trajetsStatement->fetchAll();

/*
En rechargeant la page après avoir entré la date, on récupère les trajets disponibles
depuis la base de données pour stocker les trajets dans un dictionnaire associatif $trajetsRequest
*/
$requestTrajet = null;

if (isset($_GET['date'])) {
    $vDepart = $_GET['vDepart'];
    $vArrivee = $_GET['vArrivee'];
    $date = $_GET['date'];
    $prixMax = $_GET['prixMax'];
    //$requestTrajet="SELECT villeDepart,villeArrivee,prixRecommande, nbPlaces, dates FROM trajets, covoiturages 
    //WHERE ((covoiturages.idTrajet=trajets.idTrajet) and villeDepart='".$vDepart."' and villeArrivee='".$vArrivee."')";
    $requestTrajet = "SELECT idCovoiturage, villeDepart,villeArrivee,prixRecommande, nbPlaces, dates FROM trajets, covoiturages 
    WHERE ((covoiturages.idTrajet=trajets.idTrajet) and villeDepart='" . $vDepart . "' and villeArrivee='" . $vArrivee . "' 
    and dates ='" . $date . "' and nbPlaces > 0 and prixRecommande <=" . $prixMax . ")";
    $trajetsRequestStatement = $db->prepare($requestTrajet);
    $trajetsRequestStatement->execute();
    $trajetsRequest = $trajetsRequestStatement->fetchAll();
    //echo "prixMax = ".$prixMax."euros</br>";
    //echo $requestTrajet;
    //echo $requestTrajet;
}
?>


    <header>
        <?php include('../Header/header.php'); ?>
    </header>


    <section class='bandeauBleu'>
        <img class="voiture" src="../Images/Voiture.png" />
        <!--Création de la liste des villes de départ et d'arrivée SANS doublon et on les trie par ordre alphabétique-->
        <?php
        foreach ($trajets as $trajet)
            $departNonSorted[] = $trajet["villeDepart"];
            $departSorted = array_unique($departNonSorted);
            sort($departSorted); 
        foreach ($trajets as $trajet)
            $arriveeNonSorted[] = $trajet["villeArrivee"];
            $arriveeSorted = array_unique($arriveeNonSorted);
            sort($arriveeSorted);
        ?>

        <form action="recherche.php" method="get">
            <div class="rechercheBarre">
                <div class="rechercheBarre_select">
                    <select name="vDepart" class="rechecheBarre_select--villeDepart" id="vDepart">
                        <option class="rechercheBarre_select--villeDepart--option"> Départ </option>
                        <?php foreach ($departSorted as $item)
                            echo '<option class="rechercheBarre_select--villeDepart--option">' . $item . '</option>';
                        ?>
                    </select>
                    <button type="button" onclick="switchDestination(rotatePicture360)" id="rotateAction"
                        class="switchButton">
                        <img class="switchPicture" id="pictureToRotate" src="../Images/switch.png" />
                    </button>
                    <!--A prendre sur la table trajet-->
                    <!-- <label for="destination">Destination :</label></br> -->
                    <select name="vArrivee" class="rechercheBarre_select--villeArrivee" id="vArrivee">
                        <option class="rechercheBarre_select--villeArrivee--option"> Arrivée </option>
                        <?php foreach ($arriveeSorted as $item)
                            echo '<option class="rechercheBarre_select--villeArrivee--option">' . $item . '</option>';
                        ?>
                    </select>
                </div>

                <div class="rechercheBarre_input">
                    <!-- <label for="date">Date du voyage :</label></br> -->
                    <input type="date" class="rechercheBarre_input--calendrier" name="date" id="date"
                        value="<?php echo date('Y-m-d') ?>" ; required />
                    <!-- <label for="nombreDePlace">Nombre de places :</label></br> -->
                    <input type="number" class="rechercheBarre_input--number" name="nombreDePlace" value="1"
                        id="nombreDePlace" maxlength="1" max="7" min="1" required />
                </div>

            </div>

            <div class="filtreAndSubmitButton">
                <div class="filtre">
                    <label for="prix" class="prixLabel">Filtrage par Prix Maximal :</label>
                    <div class="filtreButton">
                        <button type="button" class="button_change_prix" id="decremente" onclick="changePrix(this)"> -
                        </button>
                        <input type="number" name="prixMax" class="prix" id="prixMax" min="10" step="5" required/>
                        <button type="button" class="button_change_prix" id="incremente" onclick="changePrix(this)"> +
                        </button>
                    </div>
                </div>
                <input type="submit" class="BtnConnex" id="btn_rechercher" value="Rechercher" />
            </div>
        </form>
    </section>

    <section class='result'>
        <!--Test si une valeur date est présente dans $_GET['date'] et si on a trouvé des trajets (dans $trajetsRequest)
        si c'est le cas, affichage de radio bouton avec les différents trajets-->
        <?php if ((isset($_GET['date'])) && (!empty($trajetsRequest)) && (!empty($_SESSION['USER_NAME']))): ?>
        <form method='get' action="validation.php">
            <p>Veuillez choisir le trajet que vous voulez réserver :<br />
            <p>
            <table class='tabResult'>
                <tr>
                    <th>Choix</th>
                    <th>Date</th>
                    <th>Départ</th>
                    <th>Destination</th>
                    <th>Prix</th>
                    <th>Nbr Places</th>
                </tr>
                <?php foreach ($trajetsRequest as $trajeTrouve): ?>
                <tr>
                    <td> <input type="radio" name="idCovoiturageChoisi" value=<?php echo $trajeTrouve["idCovoiturage"] ?>
                        id="" /></td>
                    <td>
                        <?php echo $trajeTrouve['dates'] ?>
                    </td>
                    <td>
                        <?php echo $trajeTrouve['villeDepart'] ?>
                    </td>
                    <td>
                        <?php echo $trajeTrouve['villeArrivee'] ?>
                    </td>
                    <td>
                        <?php echo $trajeTrouve['prixRecommande'] ?>
                    </td>
                    <td>
                        <?php echo $trajeTrouve['nbPlaces'] ?>
                    </td>
                </tr>

                <!--<input type="radio" name="idCovoiturageChoisi" value=<?php echo $trajeTrouve["idCovoiturage"] ?> id="" /><label>
                <?php echo $trajeTrouve['dates'] . " " . $trajeTrouve['villeDepart'] . " " . $trajeTrouve['villeArrivee'] . " "
                    . $trajeTrouve['prixRecommande'] . " " . $trajeTrouve['nbPlaces'];
                echo "</br>"; ?> 
                </label><br />
                -->
                <?php endforeach; ?>
            </table>

            <input type="submit" class="BtnConnex" id=BtnConnex_Reserver value="Réserver">
        </form>
        <?php endif; ?>
        <!--Bloc de code qui teste si une $_GET['date'] et renvoie une liste texte de toutes les offres
        ou une phrase : Désolé, pas de trajets.....-->
        <?php if (isset($_GET['date'])) {
            if (!empty($trajetsRequest) && (empty($_SESSION['USER_NAME']))) {

                echo "<table class='tabResult'> <tr> <th>Date</th> <th>Départ</th>  <th>Destination</th>  <th>Prix</th>  <th>Nbr Places</th></tr>";
                foreach ($trajetsRequest as $trajeTrouve) {
                    echo "<tr> 
                        <td>" . $trajeTrouve['dates'] . "</td>
                        <td>" . $trajeTrouve['villeDepart'] . "</td>
                        <td>" . $trajeTrouve['villeArrivee'] . "</td>
                        <td>" . $trajeTrouve['prixRecommande'] . "</td>
                        <td>" . $trajeTrouve['nbPlaces'] . "</td>
                    </tr>";
                }
                echo "</table>";
                echo "<p> Si vous désirez réserver un trajet, merci de vous connecter. </p>";
            } elseif (empty($trajetsRequest)) {
                echo "Désolé, il n'y a pas de trajet qui correspond à vos critères de recherche";
            }
        }
        ?>
    </section>


    <?php include('../Footer/footer.html'); ?>
    <script src="../Script/switchVille.js"></script>
    <script src="../Script/changePrix.js"></script>
</body>

</html>