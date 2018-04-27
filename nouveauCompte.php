<?php
include_once 'Include/genererSession.include.php';
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

<div class="bodyC centerDefault">
    <h1>Création de votre compte</h1>
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
</div>

<div class="bodyR">
    <label id="vEmail">L'addresse e-mail est valide</label>
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
    <a href="index.php">Déjà un compte? Appuyer ici!</a>
</div>

<div class="footerR">

</div>
</body>
</html>
