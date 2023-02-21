<link rel="stylesheet" href="../Header/styleHeader.css" />
<title>Header</title>

<div class="header_logo" onclick="window.location.href='../Index/index.php'">
    <img class="logo" src="../Images/logo.png" />
    <h1><a id="a">HereWeGo</a></h1>
</div>

<div class="header_option">
    <a class="Btn" href="../Publication/publier.php"><img src="../Images/plus.png" /> Publier</a>

    <a class="Btn" href="../Recherche/recherche.php"><img src="../Images/fi-rr-search.png" /> Rechercher</a>

    <?php
        if (!isset($_SESSION['USER_NAME']))
            echo "<a class='BtnConnex' href='../Connexion/connexion.php'>Connexion</a>";
        else
            echo "<a class='BtnConnex' href=''>" . $_SESSION['USER_NAME'] . "</a>";
        if (isset($_SESSION['USER_NAME']))
            echo "<a class='BtnConnex' id='BtnConnex_deconnexion' href='../Connexion/deconnexion.php'>Deconnexion</a>";
        ?>
</div>