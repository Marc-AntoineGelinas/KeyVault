<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$verification = new Requete();
$encryption = new encryption();
$reponse = $_POST['reponse'];
$id = $_POST['id'];

$verification = $verification->requeteSQLPDO("SELECT email, reponseSecurite FROM users_informations WHERE id = :param1", array($id), __FILE__);
$resultat = $verification->fetch(PDO::FETCH_ASSOC);
$email = $encryption->encrypterInfos($resultat['email'], "d");


if ($encryption->encrypterInfos($resultat['reponseSecurite'], "d") == $reponse){
    $recovery = rand(1000000000,9999999999);
    $recoveryEncrypter = $encryption->encrypterInfos($recovery);

    $requete = new requete();
    $requete->requeteSQLPDO("UPDATE users_informations SET recovery=:param1 WHERE id=:param2", array($recovery, $id), __FILE__);

        $lienActivation = "https://marc.simon987.net/reinitialiser.php?id=" . $recovery;
        $message = "Veuillez allez sur ce lien pour la réinitialisation du mot de passe : " . $lienActivation;
        mail($email,"KeyVault - Réinitialiser mot de passe" , $message, mailHeader);

        $message = "Un e-mail vous a été envoyé pour la réinitialisation du mot de passe.";
        $_SESSION['Notification'] = $message;
        header("Location: ../index.php");
}
else{
        $message = "La réponse à la question de sécurité est invalide.";
        $_SESSION['Notification'] = $message;
        header("Location: ../index.php");
}