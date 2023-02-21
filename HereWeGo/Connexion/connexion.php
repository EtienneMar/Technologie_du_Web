<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styleConnexion.css" />
    <title>Here We Go</title>
</head>

<body>
    <header>
        <?php include('../Header/header.php'); ?>
    </header>
    <section class='bandeauBleu'>
        <img class="voiture" src="../Images/Voiture.png" />
        <div class="connection">
            <p>Merci de renseigner les informations afin de vous connecter :</p>
            <?php include('./login.php') ?>
        </div>
    </section>
    </div>

    <?php include('../Footer/footer.html'); ?>

</body>

</html>