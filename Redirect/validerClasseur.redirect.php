<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
$verification = new requete();
$idClasseur = $_POST['classeur'];


$verification = $verification->requeteSQLPDO("SELECT users_vault.id, users_vault.master
FROM users_vault
INNER JOIN users_informations
ON users_vault.users_informations_id = users_informations.id
WHERE users_informations.email = :param1 AND users_vault.id = :param2", array($_SESSION['usager'], $idClasseur));

if ($verification->rowCount() != 1){
    $message = "Ce classeur ne vous appartient pas.";
    header("Location: ../listeClasseurs.php");
}
else
{
    $classeur = $verification->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idClasseur'] = $classeur['id'];
    if ($classeur['master'] == null){
        header("Location: ../classeur.php");
    }
    else{
        ?>

        <html>
        <head>
            <meta charset="UTF-8">

            <title>Key Vault - Accueil</title>
            <link rel="stylesheet" type="text/css" href="../CSS/main.css">
            <link rel="stylesheet" type="text/css" href="../CSS/grid.css">
        </head>
        <body class="main-Grid">
        <div id="headerL">
            <a>Keyvault</a>
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
            <a class="titre">Entrer le mot de passe du classeur</a>
            <form  name="formLogin" method="post" action="validerMDPClasseur.redirect.php">
                <input type="password" name="pass" id="pass" placeholder="Mot de passe">
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

        <?php
    }
}

