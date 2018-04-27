<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
include_once 'Classe/encryption.classe.php';
include_once "Classe/gestionBd.classe.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$encryption = new encryption();
$requete = new Gestionbd();

$requete = $requete->getInfosClasseur($_POST['nomClasseur']);

$resultat = $requete->fetch(PDO::FETCH_ASSOC);

$nom = $encryption->encrypterInfos($resultat['nom'], "d");

?>
<html>
<head>
    <title>Key Vault - Modifier Classeur</title>
    <script type="text/javascript" src="Javascript/validationMdp.js"></script>
    <script type="text/javascript" src="Javascript/validationClasseur.ajax.js"></script>
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
        echo '<h1 style="columns: ;color:red">' . $_SESSION['Notification'] . '</h1>';
        unset($_SESSION['Notification']);
    }
    ?>
</div>

<div class="bodyC">
    <Form name="formModifClasseur" method="post" action="Redirect/validerModifClasseur.redirect.php">
        <input type="hidden" id="idClasseur" name="idClasseur" value="<?php echo $resultat["id"] ?>">
        <label for="nom">Nom du classeur :
            <input type="text" name="Nom" id="nom" onkeyup="validationNomClasseur(this.value)" value="<?php echo $nom ?>">
        </label>
        <label type="hidden" id="hNom"></label>
        <label for="pass">Mot de passe :
            <input type="password" name="Pass" id="pass" onkeyup="confirmationCreationClasseur()">
        </label>
        <label for="pass2">Confirmer le mot de passe :
            <input type="password" name="Pass2" id="pass2" onkeyup="confirmationCreationClasseur()" disabled>
        </label>
        <button id="btnAjout" onclick="formModifClasseur.submit()" disabled>Modifier</button>


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