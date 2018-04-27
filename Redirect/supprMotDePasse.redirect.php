<?php
include_once "../Include/genererSession.include.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
include_once "../Classe/gestionBd.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$idMdp = $_POST['idMdp'];
$master = $_POST['master'];
$mdpClasseur = $_POST['mdpClasseur'];
$requete = new Gestionbd();

$requete = $requete->getInfosMotDePasse($idMdp);

$mdp = $requete->fetch(PDO::FETCH_ASSOC);

$requete = new Gestionbd();

if ($master == "false"){
    $requete = $requete->getInfosUser($mdp['users_vault_users_informations_id']);
    $user = $requete->fetch(PDO::FETCH_ASSOC);

    $requete = new Gestionbd();
   if (password_verify($mdpClasseur, $user['password'])){
       $requete->deleteMotDePasse($idMdp);

       $message = "Le mot de passe a bien été supprimer";
       $_SESSION['Notification'] = $message;
       header("Location: ../listeClasseurs.php");
    }
   else{
       $message = "Le mot de passe entré est invalide. La suppression n'a pas été effectué.";
       $_SESSION['Notification'] = $message;
       header("Location: ../listeClasseurs.php");
   }
}
else if ($master == "true"){
    $requete = $requete->getInfosClasseur($mdp['users_vault_id']);
    $classeur = $requete->fetch(PDO::FETCH_ASSOC);

    $requete = new Gestionbd();
    if (password_verify($mdpClasseur, $classeur['master'])){
        $requete->deleteMotDePasse($idMdp);

        $message = "Le mot de passe a bien été supprimer";
        $_SESSION['Notification'] = $message;
        header("Location: ../listeClasseurs.php");
    }
    else{
        $message = "Le mot de passe entré est invalide. La suppression n'a pas été effectué.";
        $_SESSION['Notification'] = $message;
        header("Location: ../listeClasseurs.php");
    }
}
?>


