<?php
include_once 'Include/genererSession.include.php';
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
        <a>Keyvault</a>
    </div>

    <div id="headerC">

    </div>

    <div id="headerR">

    </div>

    <div id="bodyL">
        <?php
        if (isset($_SESSION['Notification'])) {
            echo '<h1 style="Color:red">' . $_SESSION['Notification'] . '</h1>';
            unset($_SESSION['Notification']);
        }
        ?>
    </div>

    <div id="bodyC">
        <h1>Entrez votre l'adresse e-mail du compte pour lequel vous souhaitez réinitialiser le mot de passe.</h1>
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
        <p>Fait par Marc-Antoine Gélinas</p>
        <p>Dans le cadre du cours Projet Web 2018</p>
    </div>

    <div id="footerR">

    </div>
</body>
</html>
