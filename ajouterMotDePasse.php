<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerAccesPage.include.php';
?>
<html>
<head>
    <title>Key Vault - Ajout Mot de passe</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/grid.css">
<script type="text/javascript" src="Javascript/generateurMDP.js"></script>
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
    <p class="titre">Veuillez définir et générer le mot de passe</p>
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
            <input type="text" name="appercu" id="appercu"  readonly>
        </label>

        <input type="hidden" value="<?php echo $_POST['idClasseur'] ?>" id="idClasseur" name="idClasseur">

        <button onclick="formAjoutMdp.submit()">Ajouter le mot de passe</button>

    </form>
</div>

<div id="bodyR">
    <label type="hidden" id="eGenerateur" style="color:red"></label>
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