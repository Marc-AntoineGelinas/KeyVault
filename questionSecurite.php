<?php
include_once 'Include/genererSession.include.php';
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
    <a>Keyvault</a>
</div>

<div id="headerC">

</div>

<div id="headerR">

</div>

<div id="bodyL">
    <?php
    if (isset($_SESSION['Notification'])) {
        echo '<h1 style="Color:red">' . $_SESSION['Notification'] . '</h1>';
        unset($_SESSION['Notification']);
    }
    ?>
</div>

<div id="bodyC">
    <h1>Répondez à votre question de sécurité pour confirmer la réinitialisation de votre mot de passe principal.</h1>
    <br/>
    <h2>Votre question de sécurité : <?php echo $question; ?></h2>
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
    <p>Fait par Marc-Antoine Gélinas</p>
    <p>Dans le cadre du cours Projet Web 2018</p>
</div>

<div id="footerR">

</div>
</body>
</html>
