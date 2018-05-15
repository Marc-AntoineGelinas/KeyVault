<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
include_once 'Classe/encryption.classe.php';
include_once "Classe/gestionBd.classe.php";
$encryption = new encryption();
$requete = new Gestionbd();

$requete = $requete->getInfosClasseur($_SESSION["idClasseur"]);
unset($_SESSION["idClasseur"]);

$resultat = $requete->fetch(PDO::FETCH_ASSOC);

$nom = $encryption->encrypterInfos($resultat['nom'], "d");

?>
<html>
<head>
    <title>Key Vault - Modifier Classeur</title>
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
    <Form name="formModifClasseur" method="post" action="Redirect/validerModifClasseur.redirect.php">
        <input type="hidden" id="idClasseur" name="idClasseur" value="<?php echo $resultat["id"] ?>">
        <p class="titre">Modifier les informations du classeur</p>
        <label for="nom">Nom du classeur :
            <input type="text" name="Nom" id="nom" onkeyup="confirmationCreationClasseur()" value="<?php echo $nom ?>">
        </label>
        <label for="pass">Mot de passe :
            <input type="password" name="Pass" id="pass" onkeyup="confirmationCreationClasseur()">
        </label>
        <label for="pass2">Confirmer le mot de passe :
            <input type="password" name="Pass2" id="pass2" onkeyup="confirmationCreationClasseur()" disabled>
        </label>
        <button id="btnAjout" onclick="formModifClasseur.submit()" disabled>Modifier</button>


    </Form>
</div>

<div id="bodyR" class="section">
    <p class="titre">Validations</p>
    <label id="vNom">Le nom de classeur est valide</label>
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
    <a>Fait par Marc-Antoine Gélinas</a>
    <a>Dans le cadre du cours Projet Web 2018</a>
</div>

<div id="footerR">
    <a href="Redirect/deconnexion.redirect.php">
        <button>Déconnexion</button>
    </a>
</div>
</body>
</html>