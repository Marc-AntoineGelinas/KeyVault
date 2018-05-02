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
        <div id="headerL">
            <a href="Redirect/logoClick.redirect.php" class="logo">Keyvault</a>
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

        <div id="bodyC" class="section ListeClasseur centerDefault">
            <a class="titre">Classeur principal</a>
                <?php
                include_once 'Include/afficherClasseurs.include.php';
                ?>
            <a href="ajouterClasseur.php">Ajouter un classeur</a>
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