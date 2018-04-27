<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
include_once "Classe/encryption.classe.php";

$encryption = new encryption();
?>
<!DOCTYPE html>

<html style="width:100%; height:100%;" >
    <head>
        <meta charset="UTF-8">
        <title>Key Vault - Classeur Principal</title>
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
                echo '<h1 style="columns: ;r:red">' . $_SESSION['Notification'] . '</h1>';
                unset($_SESSION['Notification']);
            }
            ?>

        </div>

        <div class="bodyC ListeClasseur">
            <h1 style="font-size:30px; font-weight:bold;">Classeur principal</h1>
                <?php
                include_once 'Include/afficherClasseurs.include.php';
                ?>
        </div>

        <div class="bodyR">

        </div>

        <div class="footerL">

        </div>

        <div class="footerC">
                <a href="ajouterClasseur.php">Ajouter un classeur</a>
        </div>

        <div class="footerR">

        </div>
    </body>
</html>