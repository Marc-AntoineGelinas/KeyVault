<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerConnexion.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Accueil</title>
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
    <p class="titre">Bienvenue sur KeyVault!</p>
    <p>KeyVault est une plateforme de stockage et de gestion de vos différents mots de passe.
     Simplement à vous créer un compte pour créer votre classeur personnel et commencer à stocker vos mots de passe.</p>
        <form name="formConnexion" method="post" action="connexion.php" style="display:inline;">
            <button onclick="formConnexion.submit()">Connexion</button>
        </form>
        <form name="formNouveau" method="post" action="nouveauCompte.php.php" style="display:inline;">
            <button onclick="formNouveau.submit()">Nouveau compte</button>
        </form>
</div>

<div id="bodyR">
</div>

<div id="footerL">

</div>

<div id="footerC">
    <a>Fait par Marc-Antoine Gélinas</a>
    <a>Dans le cadre du cours Projet Web 2018</a>
</div>

<div id="footerR">
</div>
</body>
</html>
