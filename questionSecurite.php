<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerConnexion.include.php';
include_once "Classe/gestionBd.classe.php";
include_once "Classe/encryption.classe.php";

if (isset($_SESSION['Verification'])){
    $id = $_SESSION['Verification'];
    unset($_SESSION['Verification']);
}
else{
    header("Location: ../index.php");
}
$requete = new Gestionbd();
$encryption = new encryption();
$requete = $requete->getInfosUser($id);

$resultat = $requete->fetch(PDO::FETCH_ASSOC);
$question = $encryption->encrypterInfos($resultat['questionSecurite'], "d");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Question sécurité</title>
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
    <p class="titre">Répondez à votre question de sécurité pour confirmer la réinitialisation de votre mot de passe principal.</p>
    <p class="titre">Votre question de sécurité : <?php echo $question; ?></p>
    <Form name="formSecurite" method="post" action="Redirect/validerSecurite.redirect.php">
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <label for="reponse">Réponse :
            <input type="password" name="reponse" id="reponse">
        </label>
        <button onclick="formSecurite.submit()">Recouvrir</button>
    </Form>
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
