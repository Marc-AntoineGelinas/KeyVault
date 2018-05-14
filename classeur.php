<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
include_once 'Include/validerAccesClasseur.include.php';
include_once 'Classe/gestionBd.classe.php';
include_once "Classe/encryption.classe.php";

$encryption = new encryption();

$idClasseur = $_SESSION['idClasseur'];
unset($_SESSION['idClasseur']);
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Key Vault - Vault</title>
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
    <a><?php echo $encryption->encrypterInfos($_SESSION['usager'], "d"); ?></a>
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

<div id="bodyC" class="centerDefault section classeur">
    <div>

        <?php
        include_once 'Include/afficherMotsDePasse.include.php';
        ?>

    </div>
    <form name="formNouveauMdp" method="post" action="ajouterMotDePasse.php">
        <input type="hidden" id="idClasseur" name="idClasseur" value="<?php echo $idClasseur ?>">
        <button onclick="formNouveauMdp.submit()">Ajouter un nouveau mot de passe</button>
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
