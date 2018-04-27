<?php
include_once 'Include/genererSession.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Accueil</title>
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
            echo '<h1 style="Color:red">' . $_SESSION['Notification'] . '</h1>';
            unset($_SESSION['Notification']);
        }
        ?>
    </div>

    <div class="bodyC centerDefault">
        <h1>Connexion</h1>
        <Form name="formLogin" method="post" action="Redirect/validerSession.redirect.php">
            <label for="email">Adresse e-mail :
                <input type="text" name="email" id="email">
            </label>
            <label for="pass">Mot de passe :
                <input type="password" name="pass" id="pass">
            </label>
            <button onclick="formLogin.submit()">Login</button>
        </Form>
    </div>

    <div class="bodyR">
    </div>

    <div class="footerL">
    </div>

    <div class="footerC">
        <a href="nouveauCompte.php">Pas de compte?</a>
        <br/>
        <a href="oublieMotDePasse.php">Oublier votre compte?</a>
    </div>

    <div class="footerR">
    </div>
</body>
</html>
