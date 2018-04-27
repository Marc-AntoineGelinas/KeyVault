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

<div class="bodyC">
    <Form name="formActivation" method="post" action="Redirect/validerActivation.redirect.php">
        <label for="email">Adresse e-mail :
            <input type="text" name="email" id="email">
        </label>
        <label for="pass">Mot de passe :
            <input type="password" name="pass" id="pass">
        </label>
        <label for="code">Code d'activation :
            <input type="text" name="code" id="code">
        </label>
        <br/>
        <br/>
        <h3>Veuillez saisir une question de sécurité pour validé votre identité en cas de perte de mot de passe.</h3>
        <label for="question">Question de sécurité :
            <input type="text" name="question" id="question">
        </label>
        <label for="reponse">Réponse :
            <input type="text" name="reponse" id="reponse">
        </label>
        <button onclick="formActivation.submit()">Activer</button>
    </Form>
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
