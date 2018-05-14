<?php
include_once 'Include/genererSession.include.php';
include_once 'Include/validerConnexion.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <link rel="stylesheet" type="text/css" href="CSS/grid.css">
</head>

<body class="main-Grid">
    <div id="headerL">
        <a href="Redirect/logoClick.redirect.php" class="logo"><img src="Ressources/Logo.png"></a>
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
        <p class="titre">Entrez votre l'adresse e-mail pour lequel vous souhaitez réinitialiser le mot de passe.</p>
        <Form name="formOublie" method="post" action="Redirect/validerOublie.redirect.php">
            <label for="email">Adresse e-mail :
                <input type="text" name="email" id="email">
            </label>
            <button onclick="formOublie.submit()">Accepter</button>
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
