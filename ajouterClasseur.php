<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Nouveau classeur</title>
    <script type="text/javascript" src="Javascript/validationMdp.js"></script>
    <script type="text/javascript" src="Javascript/validationClasseur.ajax.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
</head>


<body class="main-Grid">
<div class="headerL">
    <a style="font-family: impact; font-size:larger;">Keyvault</a>
</div>

<div class="headerC">

</div>

<div class="headerR">

</div>

<div class="bodyL">
    <?php
    if (isset($_SESSION['Notification'])) {
        echo '<h1 style="Color:red">' . $_SESSION['Notification'] . '</h1>';
        unset($_SESSION['Notification']);
    }
    ?>
</div>

<div class="bodyC">
    <Form name="formNouveauClasseur" method="post" action="Redirect/validerNouveauClasseur.redirect.php">
        <label for="nom">Nom du classeur :
            <input type="text" name="Nom" id="nom" onkeyup="validationNomClasseur(this.value)">
        </label>
        <label type="hidden" id="hNom"></label>
        <label for="pass">Mot de passe :
            <input type="password" name="Pass" id="pass" onkeyup="confirmationCreationClasseur()">
        </label>
        <label for="pass2">Confirmer le mot de passe :
            <input type="password" name="Pass2" id="pass2" onkeyup="confirmationCreationClasseur()" disabled>
        </label>
        <button id="btnAjout" onclick="formNouveauClasseur.submit()" disabled>Ajouter</button>
    </Form>
</div>

<div class="bodyR">
    <label id="vNom">Le nom de classeur est valide</label>
    <label id="vMinMax">Votre mot de passe doit contenir entre 10 et 32 caractères</label>
    <label id="vLowercase">Votre mot de passe doit contenir un caractère lowercase</label>
    <label id="vUppercase">Votre mot de passe doit contenir un caractères uppercase</label>
    <label id="vNumerique">Votre mot de passe doit contenir un chiffre</label>
    <label id="vSpecial">Votre mot de passe doit contenir un caractère spécial</label>
    <label id="vConfirmer">Votre confirmation concorde avec le mot de passe</label>
</div>

<div class="footerL">

</div>

<div class="footerC">

</div>

<div class="footerR">

</div>
</body>
</html>
