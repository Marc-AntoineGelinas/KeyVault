<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
?>
<html>
<head>
    <title>Key Vault - Ajout Mot de passe</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
<script type="text/javascript" src="Javascript/generateurMDP.js"></script>
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
    <form name="formAjoutMdp" method="post" action="Redirect/validerAjoutMotDePasse.redirect.php">
        <label for="nom">Nom du mot de passe:
            <input type="text" name="nom" id="nom" max="255" placeholder="ex: Facebook">
        </label>

        <label for="nombre">Longueur du mot de passe:
            <input type="number" name="nombre" id="nombre" min="10" max="32" value="10">
        </label>

        <label for="lowercase">Utiliser des miniscules :
            <input type="checkbox" name="lowercase" id="lowercase" checked>
        </label>

        <label for="uppercase">Utiliser des majuscules:
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
            <input type="text" name="appercu" id="appercu" size="32" readonly>
        </label>

        <input type="hidden" value="<?php echo $_POST['idClasseur'] ?>" id="idClasseur" name="idClasseur">

        <button onclick="formAjoutMdp.submit()">Ajouter le mot de passe</button>

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