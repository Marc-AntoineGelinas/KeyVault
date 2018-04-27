<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
$verification = new Requete();
$temporaire = new Requete();
$activation = new Requete();
$ajout = new Requete();
$encryption = new encryption();

$email = $encryption->encrypterInfos($_POST['email']);

$temporaire = $temporaire->requeteSQLPDO("SELECT email FROM users_temporaires WHERE email = :param1", array($email), __FILE__);


//Valide si le compte existe déjà en attente d'activation
if ($temporaire->rowCount() !=0){
    $message = "Votre compte est déjà créer et en attente d'activation. Vérifié votre boite courriel pour le code d'activation.";
    $activation = $activation->requeteSQLPDO("SELECT activation FROM users_temporaires WHERE email = :param1", array($email), __FILE__);
    $activation = $encryption->encrypterInfos($activation, "d");

    //Renvoie le code d'activation à l'adresse e-mail
    $lienActivation = "https://marc.simon987.net/activation.php";
    $message = "Voici votre code d'activation : " . "<b>" .$activation. "</b>" . "\n" . "\n" . "Veuillez allez sur ce lien pour l'activation : " . $lienActivation;
    mail($_POST['email'],"KeyVault - Activation" , $message, mailHeader);

    header("Location: ../activation.php");
}
else {
//Vérifie si le e-mail est déjà utilisé.
    $verification = $verification->requeteSQLPDO("SELECT email FROM users_informations WHERE email = :param1", array($email), __FILE__);

//Si l'adresse n'existe pas, on l'ajoute à la base de données et le compte est créé.
    if ($verification->rowCount() == 0) {
        $codeActivation = rand(10000,99999);
        $activationEncrypte = $encryption->encrypterInfos($codeActivation);

        $mdp = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        $ajout = $ajout->requeteSQLPDO("INSERT INTO users_temporaires (email, password, activation) VALUES (:param1, :param2, :param3)", array($email, $mdp, $activationEncrypte), __FILE__);


        $lienActivation = "https://marc.simon987.net/activation.php";
        $message = "Voici votre code d'activation : " . $codeActivation . "\n" . "\n" . "Veuillez allez sur ce lien pour l'activation : " . $lienActivation;
        mail($_POST['email'],"KeyVault - Activation" , $message, mailHeader);

        $message = "Votre compte a été créé. Un e-mail vous a été envoyé pour l'activation.";
        $_SESSION['Notification'] = $message;
        header("Location: ../activation.php");
    } else {
        $ajoutLog = new AjouterLog("logConnexionEchoue.log", "Compte déjà existant : " . $_POST['email'], __FILE__);
        $message = "L'adresse e-mail est déjà utilisé.";
        $_SESSION['Notification'] = $message;
        header("Location : ../nouveauCompte.php");
    }
}