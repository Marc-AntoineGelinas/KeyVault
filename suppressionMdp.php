<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
include_once 'Classe/encryption.classe.php';
include_once "Classe/gestionBd.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$encryption = new encryption();
$requete = new Gestionbd();
$requete = new Gestionbd();

$requete = $requete->getInfosMotDePasse($_POST['nomMdp']);

$resultatMdp = $requete->fetchall(PDO::FETCH_ASSOC);

$requete = new Gestionbd();

$requete = $requete->getInfosClasseur($resultatMdp[0]['users_vault_id']);

$resultatClasseur = $requete->fetchall(PDO::FETCH_ASSOC);

$nom = $encryption->encrypterInfos($resultatMdp[0]['nom'], "d");
?>
<html>
    <head>
        <title>Key Vault - Supprimer mot de passe</title>
        <script type="text/javascript" src="Javascript/generateurMDP.js"></script>
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
        <p class="titre">Êtes-vous certain de vouloir supprimer : <?php echo $nom ?></p>
        <p class="titre" style="color:red;">Attention! Une fois le mot de passe effacé, il ne pourra pas être récupperé!</p>
        <form name="formModifMdp" method="post" action="Redirect/supprMotDePasse.redirect.php">

            <input type="hidden" id="idMdp" name="idMdp" value="<?php echo $resultatMdp[0]['id'];?>">

            <?php
            if ($resultatClasseur[0]['master'] == null) {
                echo "<label for='mdpClasseur'>Mot de passe principal : ";
                echo "<input type='hidden' id='master' name='master' value='false'>";
            }
            else {
                echo "<label for='mdpClasseur'>Mot de passe du classeur : ";
                echo "<input type='hidden' id='master' name='master' value='true'>";
            }

            echo "<input type='password' id='mdpClasseur' name='mdpClasseur'>";
            echo "</label>";
            ?>
            <button onclick="formModifMdp.submit()">Supprimer le mot de passe</button>
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