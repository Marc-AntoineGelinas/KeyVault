<?php
include_once "../Include/genererSession.include.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
include_once "../Classe/gestionBd.classe.php";
$id = $_POST['idMdp'];
$modif = new Gestionbd();
$encryption = new encryption();
$mdp = filter_var($_POST['appercu'], FILTER_SANITIZE_STRING);
$nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
$idClasseur = $_POST['idClasseur'];



if (strlen($mdp) == 0 || strlen($nom) == 0){
    $message = "Le mot de passe et le nom ne peuvent pas être vide.";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
    die();
} else if (strlen($mdp) < 10 || strlen($mdp) > 32){
    $message = "Le mot de passe doit contenir entre 10 et 32 caractères.";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
    die();
} else if (strlen($nom) < 1 || strlen($nom) > 255){
    $message = "Le nom doit contenir entre 1 et 255 caractères.";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
    die();
}
else
{
    $mdp = $encryption->encrypterInfos($mdp);
    $nom = $encryption->encrypterInfos($nom);
}

if ($id != ""){


    $modif->setInfosMotDePasse($id, $nom, $mdp, $idClasseur);

    $message = "Le mot de passe a été modifié";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
}
else {
    $message = "Une erreur est survenu... Veuillez ré-essayer.";
    $_SESSION['Notification'] = $message;
    header("Location : ../listeClasseurs.php");
}
