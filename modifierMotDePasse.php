<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
include_once 'Classe/encryption.classe.php';
include_once "Classe/gestionBd.classe.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$encryption = new encryption();
$requete = new Gestionbd();

$requete = $requete->getInfosMotDePasse($_POST['idMdp']);

$resultat = $requete->fetchall(PDO::FETCH_ASSOC);

$nom = $encryption->encrypterInfos($resultat[0]['nom'], "d");
$password = $encryption->encrypterInfos($resultat[0]['password'], "d");
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
            <form name="formModifMdp" method="post" action="Redirect/validerModifMotDePasse.redirect.php">
                <label for="nom">Nom du mot de passe:
                    <input type="text" name="nom" id="nom" max="255" placeholder="ex: Facebook" value="<?php echo $nom; ?>">
                </label>

                <label for="nombre">Longueur du mot de passe:
                    <input type="number" name="nombre" id="nombre" min="10" max="32" value="10">
                </label>
                <label for="lowercase">Utiliser des lower case :
                    <input type="checkbox" name="lowercase" id="lowercase" checked>
                </label>

                <label for="uppercase">Utiliser des upper case :
                    <input type="checkbox" name="uppercase" id="uppercase">
                </label>

                <label for="chiffres">Utiliser des chiffres :
                    <input type="checkbox" name="chiffres" id="chiffres">
                </label>

                <label for="special">Utiliser des caractères spéciaux :
                    <input type="checkbox" name="special" id="special">
                </label>

                <button type="button" onclick="generateur()">Generer un mot de passe aléatoire</button>

                <label for="appercu">Apperçu :
                    <input type="text" name="appercu" id="appercu" size="32" readonly value="<?php echo $password; ?>">
                </label>

                <input type="hidden" value="<?php echo $_POST['idMdp']; ?>" id="idMdp" name="idMdp">

                <input type="hidden" value="<?php echo $resultat[0]['users_vault_id']; ?>" id="idClasseur" name="idClasseur">

                <button onclick="formModifMdp.submit()">Modifier le mot de passe</button>

            </form>
        </div>

        <div class="bodyR">
            <label type="hidden" id="eGenerateur" style="color:red"></label>
        </div>

        <div class="footerL">

        </div>

        <div class="footerC">

        </div>

        <div class="footerR">

        </div>
    </body>
</html>