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
<div class="headerL">
    <a style="font-family: impact; font-size:larger;">Keyvault</a>
</div>

<div class="headerC">

</div>

<div class="headerR">
    <label style="float:right;"><?php echo $encryption->encrypterInfos($_SESSION['usager'], "d"); ?></label>
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

<div class="bodyR">

</div>

<div class="footerL">

</div>

<div class="footerC">

</div>

<div class="footerR">

</div>
</body>
</html>
