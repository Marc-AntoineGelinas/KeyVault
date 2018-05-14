<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerConnexion.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Key Vault - Nouveau Compte</title>
    <script type="text/javascript" src="Javascript/validationEmail.ajax.js"></script>
    <script type="text/javascript" src="Javascript/validationMdp.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/grid.css">
</head>
<body class="main-Grid">
<div id="headerL">
    <a href="Redirect/logoClick.redirect.php" class="logo"><img src="Ressources/Logo.png"></a>
</div>

<div id="headerC">

</div>

<div id="headerR">

</div>


    <?php
    if (isset($_SESSION['Notification'])) {
        echo "<div id='bodyL' class='section'>";
        echo '<h1 style="Color:red">' . $_SESSION['Notification'] . '</h1>';
        unset($_SESSION['Notification']);
    }
    else
        echo "<div id='bodyL'>";
    ?>
</div>

<div id="bodyC" class="section centerDefault">
    <p class="titre">Création de votre compte</p>
    <Form name="formNouveauCompte" method="post" action="Redirect/validerNouveauCompte.redirect.php">
        <label for="email">Adresse e-mail :
            <input type="text" name="email" id="email" onkeyup="validationEmail(this.value)">
        </label>
        <label type="hidden" id="eEmail"></label>
        <label type="hidden" id="hEmail"></label>
        <label for="pass">Mot de passe :
            <input type="password" name="pass" id="pass" onkeyup="confirmationCreationCompte()">
        </label>
        <label for="pass2">Confirmer le mot de passe :
            <input type="password" name="Pass2" id="Pass2" onkeyup="confirmationCreationCompte()">
        </label>
        <button id="btnAjout" onclick="formNouveauCompte.submit()" disabled>Créer</button>
    </Form>
    <a href="connexion.php">Déjà un compte? Appuyer ici!</a>
</div>

<div id="bodyR" class="section">
    <p class="titre">Validations</p>
    <label id="vEmail">L'addresse e-mail est valide</label>
    <label id="vMinMax">Votre mot de passe doit contenir entre 10 et 32 caractères</label>
    <label id="vLowercase">Votre mot de passe doit contenir un caractère lowercase</label>
    <label id="vUppercase">Votre mot de passe doit contenir un caractères uppercase</label>
    <label id="vNumerique">Votre mot de passe doit contenir un chiffre</label>
    <label id="vSpecial">Votre mot de passe doit contenir un caractère spécial</label>
    <label id="vConfirmer">Votre confirmation concorde avec le mot de passe</label>
</div>

<div id="footerL">

</div>

<div id="footerC">
    <a>Fait par Marc-Antoine Gélinas</>
    <a>Dans le cadre du cours Projet Web 2018</a>
</div>

<div id="footerR">

</div>
</body>
</html>
