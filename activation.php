<?php
include_once 'Include/genererSession.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Activation</title>
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
            echo "</div>";
        }
        else
            echo "<div id='bodyL'>";
            echo "</div>";
        ?>


    <div id="bodyC" class="section centerDefault">
        <Form name="formActivation" method="post" action="Redirect/validerActivation.redirect.php">
            <p class="titre">Entrer vos informations d'activation</p>
            <label for="email">Adresse e-mail :
                <input type="text" name="email" id="email">
            </label>
            <label for="pass">Mot de passe :
                <input type="password" name="pass" id="pass">
            </label>
            <label for="code">Code d'activation :
                <input type="text" name="code" id="code">
            </label>
            <p class="titre">Veuillez saisir une question de sécurité pour validé votre identité en cas de perte de mot de passe.</p>
            <label for="question">Question de sécurité :
                <input type="text" name="question" id="question">
            </label>
            <label for="reponse">Réponse :
                <input type="text" name="reponse" id="reponse">
            </label>
            <button onclick="formActivation.submit()">Activer</button>
        </Form>
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
