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

$resultatClasseur = $requete->fetch(PDO::FETCH_ASSOC);

$nom = $encryption->encrypterInfos($resultatClasseur['nom'], "d");

$requete = new Gestionbd();

?>
<html>
    <head>
        <title>Key Vault - Supprimer classeur</title>
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
            <h2 style="color:red;">Attention! Une fois le classeur effacé, il ne pourra pas être récupperé!</h2>
            <br/>
            <h3 style="color:red;">Une fois le classeur effacé, tous les mots de passes qu'il contenait seront aussi effacés!</h3>
            <form name="formSupprClasseur" method="post" action="Redirect/supprClasseur.redirect.php">

                <input type="hidden" id="idClasseur" name="idClasseur" value="<?php echo $resultatClasseur['id'];?>">

                <?php
                if ($resultatClasseur['master'] == null) {
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
                <button onclick="formSupprClasseur.submit()">Supprimer le classeur</button>
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