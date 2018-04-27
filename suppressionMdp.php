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
        <title>Key Vault - Modifier mot de passe</title>
        <script type="text/javascript" src="Javascript/generateurMDP.js"></script>
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
        <h1>Êtes-vous certain de vouloir supprimer : <?php echo $nom ?></h1>
        <h2 style="color:red;">Attention! Une fois le mot de passe effacé, il ne pourra pas être récupperé!</h2>
        <form name="formModifMdp" method="post" action="Redirect/supprMotDePasse.redirect.php">

            <input type="hidden" id="idMdp" name="idMdp" value="<?php echo $resultatMdp[0]['id'];?>">

            <?php
            if ($resultatClasseur[0]['master'] == null) {
                echo "<label for='mdpClasseur'>Entrer votre mot de passe principal :";
                echo "<input type='hidden' id='master' name='master' value='false'>";
            }
            else {
                echo "<label for='mdpClasseur'>Entrer le mot de passe du classeur :";
                echo "<input type='hidden' id='master' name='master' value='true'>";
            }

            echo "<input type='password' id='mdpClasseur' name='mdpClasseur'>";
            echo "</label>";
            ?>
            <button onclick="formModifMdp.submit()">Supprimer le mot de passe</button>
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