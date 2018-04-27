<?php
include_once 'Include/genererSession.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Activation</title>
    <style type="text/css">
        label {
            display : block;
        }
    </style>
</head>
<body>
<header>
    <?php
    if (isset($_SESSION['Notification'])) {
        echo '<h1 style="Color:red">' . $_SESSION['Notification'] . '</h1>';
        unset($_SESSION['Notification']);
    }
    ?>
</header>
<section>
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
    <br>
</section>

</body>
</html>
