<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleIndex.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
    <title>Here We Go</title>
</head>

<body>

    <?php

    include('../Bdd/connexionSQL.php');
    $request = 'SELECT DISTINCT t.villeDepart, t.villeArrivee, COUNT(c.idCovoiturage) as nombreCovoit FROM covoiturages c, trajets t WHERE c.idTrajet=t.idTrajet GROUP BY t.idTrajet LIMIT 3';
    $trajetsPopulairesStatement = $db->prepare($request);
    $trajetsPopulairesStatement->execute();
    $trajetsPopulaires = $trajetsPopulairesStatement->fetchAll();
    /*var_dump($trajetsPopulaires);
    echo "<table border='1'>";
    echo "<tr><td>villeDepart</td><td>villeArrivee</td><td>nombreCovoit</td></tr>\n";
    foreach ($trajetsPopulaires as $trajet){
    echo "<tr><td>{$trajet['villeDepart']}</td><td>{$trajet['villeArrivee']}</td><td>{$trajet['nombreCovoit']}</td></tr>\n";
    }
    echo "</table>";
    */
    foreach ($trajetsPopulaires as $trajet)
        $listeVilleDepart[] = $trajet["villeDepart"]; foreach ($trajetsPopulaires as $trajet)
        $listeVilleArrivee[] = $trajet["villeArrivee"];
    ?>



    <header>
        <?php include('../Header/header.php'); ?>
    </header>

    <section class='bandeauBleu'>
        <img class="voiture" src="../Images/Voiture.png" />
        <p class='texteAccueil'>C’est le moment de Partir ! </br> Choissez votre destination à petit prix... </p>
    </section>
    <section>
        <div class='allboiteTexte'>
            <div class='boiteTexte'>
                <p class="boiteTexte-title">Vos trajets préférés à petits prix.</p>
                <p class="boiteTexte--content">Qu’importe votre destination, trouvez le covoiturage idéal parmi les
                    conducteurs proposés.Toujours à petits prix !</p>
            </div>

            <div class='boiteTexte'>
                <p class="boiteTexte-title">Garantie retour à la maison.</p>
                <p class="boiteTexte--content">Grâce à nos partenaires, si votre conducteur annule au dernier moment,
                    nous vous ramenerons à la maison.</p>
            </div>
            <div class='boiteTexte'>
                <p class="boiteTexte-title">Fiabilité et sécurité.</p>
                <p class="boiteTexte--content">Grâce à notre système de notation collaborative nous prennons le temps de
                    vérifier les profils des membres.</p>
            </div>
        </div>
    </section>

    <section class='bandeauBleu' id='secondBandeau'>
        <div class="trajetPopulaire">
            <p class="trajetPopulaire-title">Le top des trajets les plus populaires </p>
            <p></p>
            <div class="trajetPopulaire_button">
                <button type="submit" class="trajetPopulaire_button-reponse" id="trajetPopulaire_button--reponse1">
                    <div class="button_content" id="button_content0">
                        <?php echo '<p class=villeDepart>' . $listeVilleDepart[0] . '</p>'; ?>
                        <span class="arrow" id='arrow0'>↪</span>
                        <?php echo '<p class=villeArrivee>' . $listeVilleArrivee[0] . '</p>'; ?>
                    </div>
                </button>
                <button type="submit" class="trajetPopulaire_button-reponse" id="trajetPopulaire_button--reponse2">
                    <div class="button_content" id="button_content1">
                        <?php echo '<p class=villeDepart>' . $listeVilleDepart[1] . '</p>'; ?>
                        <span class="arrow" id='arrow1'>↪</span>
                        <?php echo '<p class=villeArrivee>' . $listeVilleArrivee[1] . '</p>'; ?>
                    </div>
                </button>
                <button type="submit" class="trajetPopulaire_button-reponse" id="trajetPopulaire_button--reponse3">
                    <div class="button_content" id="button_content2">
                        <?php echo '<p class=villeDepart>' . $listeVilleDepart[2] . '</p>'; ?>
                        <span class="arrow" id='arrow2'>↪</span>
                        <?php echo '<p class=villeArrivee>' . $listeVilleArrivee[2] . '</p>'; ?>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <section class='presentation'>
        <img class="covoit" src="../Images/covoit.webp" />
        <div class="presentationTexte">
            <strong class="presentationTexte-title">Des rencontres en plus, des frais en moins...</strong></br>
            <p class="presentationTexte--content" id="text1">En covoiturant entre Montpellier et Paris, Lorenzo,
                conducteur HereWeGo et étudiant en cinéma. Économisera du carburant et
                covoiturera avec Arthur, ingénieur son, qui se proposera d'intervenir gratuitement dans son projet de
                fin d'études.
            <p class="presentationTexte--content"> S'il ne pensait économiser 80 euros, c'est raté !</p>
            <a class="BtnConnex" id="Rejoignez-nous" href="../Connexion/connexion.php"> Rejoignez-nous </a>
        </div>
    </section>

    <?php include("../Footer/footer.html") ?>
    <script src="../Script/trajetPopulaireAnimation.js"></script>



</body>

</html>