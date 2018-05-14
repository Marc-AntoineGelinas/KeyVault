<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/gestionBd.classe.php";
include_once "../Classe/encryption.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$verification = new Gestionbd();
$encryption = new encryption();
$mdp = $_POST['pass'];
$id = $_POST['id'];

$verification = $verification->getInfosUser($id);
$resultat = $verification->fetch(PDO::FETCH_ASSOC);

//
//
if (password_verify($resultat['password'], $mdp)){
    $recovery = $encryption->encrypterInfos($resultat['recovery']);

    $message = "Le nouveau mot de passe doit être différent de votre ancien.";
    $_SESSION['Notification'] = $message;
    header("Location: ../reinitialiser.php?id=". $recovery);
}
else{
    $requete = new Gestionbd();

    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

    $requete->setInfosUser($id, $mdp, $resultat['questionSecurite'], $resultat['reponseSecurite'], null);

    $message = "Votre mot  de passe a été réinitialiser";
    $_SESSION['Notification'] = $message;
    header("Location: ../connexion.php");
}