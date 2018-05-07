<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerConnexion.include.php';
include_once "Classe/gestionBd.classe.php";
include_once "Classe/encryption.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$encryption = new encryption();
if (isset($_GET['id'])){
    $recovery = $encryption->encrypterInfos($_GET['id']);
}
else{
    header("Location: ../index.php");
}
$requete = new Gestionbd();

$requete = $requete->getInfosUserV2($_GET['id']);
$idUser = $requete->fetch(PDO::FETCH_ASSOC);
$idUser = $idUser['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Réinitialiser Mot de passe</title>
    <script type="text/javascript" src="Javascript/validationMdp.js"></script>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/grid.css">
</head>
<body class="main-Grid">
<div id="headerL">
    <a href="Redirect/logoClick.redirect.php" class="logo">Keyvault</a>
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

<div id="bodyC" class="centerDefault section">
    <p class="titre">Entrer votre nouveau mot de passe. Il doit être différent de votre ancien mot de passe.</p>
    <Form name="formReinitialisation" method="post" action="Redirect/validerReinitialisation.redirect.php">
        <input type="hidden" id="id" name="id" value="<?php echo $idUser; ?>">
        <label for="pass">Nouveau mot de passe :
            <input type="password" name="pass" id="pass" onkeyup="confirmationReinitialisation()">
        </label>
        <label for="pass2">Confirmer le mot de passe :
            <input type="password" name="Pass2" id="Pass2" onkeyup="confirmationReinitialisation()">
        </label>
        <button id="btnAjout" onclick="formReinitialisation.submit()" disabled>Réinitialiser</button>
    </Form>
</div>

<div id="bodyR" class="section">
    <p class="titre">Validations</p>
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

</div>
</body>
</html>
