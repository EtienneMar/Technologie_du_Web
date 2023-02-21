<?php session_start() ?>
<?php
//Récupération des login et mots de passe pour la connection:
include("../Bdd/connexionSQL.php");
$request = 'SELECT email, motDePasse, nom FROM Internautes';
$usersStatement = $db->prepare($request);
$usersStatement->execute();
$users = $usersStatement->fetchAll();
?>


<?php
/*
 *En rechargeant la page connexion.php (et donc login.php) = vérification si il y a des valeurs dans 
 *user_log et user_password, et si presence de valeur
 *Puis, vérification si l'e-mail correspond bien au password.
 *si ce n'est pas le cas, enregistrement d'un message d'erreur qui va s'afficher par la suite....
 */
if (isset($_POST['user_log']) && isset($_POST['user_password'])) {
    foreach ($users as $user) {
        if (
            $user['email'] == $_POST['user_log'] &&
            $user['motDePasse'] == $_POST['user_password']
        ) {
            $_SESSION['USER_NAME'] = $user['nom'];
            $_SESSION['USER_MAIL'] = $user['email'];
        } else {
            $errorMessage = sprintf(
                'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['user_log'],
                $_POST['user_password']
            );
        }
    }
}
?>
<!--
Si aucun utilisateur connecté, on affiche le formulaire de login :
-->
<?php if (!isset($_SESSION['USER_NAME'])): ?>
<form action="connexion.php" method="post">
    <!-- si message d'erreur on l'affiche -->
    <?php if (isset($errorMessage)): ?>
    <div class="alert">
        <?php echo $errorMessage; ?>
    </div>
    <?php endif; ?>
    <p>
        <label for="loggin">Merci de préciser votre e-mail :</label></br>
        <input type="email" name="user_log" class="inputBoxConnexion" id="loggin" required />
    </p>
    <p>
        <label for="MDP">Veuillez entrer votre mot de passe :</label></br>
        <input type="password" name="user_password" class="inputBoxConnexion" id="MDP" required />
    </p>
    <p>
        <input type="submit" class='BtnConnex' id="Btn_SeConnecter" value="Se connecter" />

</form>
<!-- 
    Si utilisateur connecté on affiche un message de validation :
-->
<?php else: ?>
<div>
    Bonjour Mr
    <?php echo $_SESSION['USER_NAME']; ?> et bienvenue sur le site !
</div>

<button class="BtnConnex" onclick="window.location.href='../Index/index.php'" id="Btn_Retour">Retour accueil</button>
<?php endif; ?>
<!--Pour voir les email disponible et le mot de passe associé...A mettre en commentaire :
<?php foreach ($users as $user): ?>
    <p><?php echo 'email : ' . $user['email'] . ' - password : ' . $user['motDePasse']; ?></p>
<?php endforeach; ?>
-->