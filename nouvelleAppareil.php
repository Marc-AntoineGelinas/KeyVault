<?php
include_once 'Include/genererSession.include.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Key Vault - Nouvelle appareil</title>
    <style type="text/css">
        label {
            display : block;
        }
    </style>
</head>
<body>
<header>
    <h1>Vous tenter de vous connecter sur un nouvelle appareil (adresse MAC non reconnu)</h1>
    <h2>Veuillez entrer votre mot de passe pour confirmer l'accès à cette appareil</h2>
</header>
<section>
    <Form name="formNouvelleAppareil" method="post" action="Redirect/validerSession.redirect.php"
        <label for="pass">Mot de passe :
            <input type="password" name="pass" id="pass">
        </label>
        <label  for="checkbox"> Je vais réutiliser souvent cette appareil :
            <input type="checkbox" name="checkbox" id="pass">
        </label>
           <button onclick="formNouvelleAppareil.submit()">Login</button>
    </Form>
    <br>
</section>

</body>
</html>