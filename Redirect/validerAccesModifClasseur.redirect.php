<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$verification = new requete();
$_SESSION["idClasseur"] = $_POST['nomClasseur'];



$verification = $verification->requeteSQLPDO("SELECT users_vault.id, users_vault.master
FROM users_vault
INNER JOIN users_informations
ON users_vault.users_informations_id = users_informations.id
WHERE users_informations.email = :param1 AND users_vault.id = :param2", array($_SESSION['usager'], $_SESSION["idClasseur"]), __FILE__);

if ($verification->rowCount() != 1){
    $message = "Ce classeur ne vous appartient pas.";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
}
else
{
    $classeur = $verification->fetch(PDO::FETCH_ASSOC);
    if ($classeur['master'] == null){
        header("Location: ../modifierClasseur.php");
    }
    else{
        ?>

        <html>
        <head>
            <meta charset="UTF-8">

            <title>Key Vault - Valider acces classeur</title>
            <link rel="stylesheet" type="text/css" href="../CSS/main.css">
            <link rel="stylesheet" type="text/css" href="../CSS/grid.css">
        </head>
        <body class="main-Grid">
        <div id="headerL">
            <a href="../Redirect/logoClick.redirect.php" class="logo"><img src="../Ressources/Logo.png"></a>
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
            <p class="titre">Entrer le mot de passe du classeur</p>
            <form  name="formLogin" method="post" action="validerMDPClasseurModif.redirect.php">
                <label>Mot de passe :
                    <input type="password" name="pass" id="pass">
                </label>
                <button onclick="formLogin.submit();">Accèder</button>
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
            <a href="deconnexion.redirect.php">
                <button>Déconnexion</button>
            </a>
        </div>
        </body>
        </html>

        <?php
    }
}

