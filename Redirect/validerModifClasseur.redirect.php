<?php
include_once "../Include/genererSession.include.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
include_once "../Classe/gestionBd.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$id = $_POST['idClasseur'];
$modif = new Gestionbd();
$requete = new Gestionbd();
$encryption = new encryption();
$nom = filter_var($_POST['Nom'], FILTER_SANITIZE_STRING);
$mdp = $_POST['Pass'];

echo $nom;
echo "<br/>";
echo

$requete = $requete->getInfosClasseur($id);
$classeur = $requete->fetch(PDO::FETCH_ASSOC);
$requete = new Gestionbd();

if (strlen($mdp) == 0){
    $mdp = null;
    $modif->setInfosClasseur($id, $nom, $mdp);
    $message = "Les modifications ont étés apportés au classeur.";
    $_SESSION['Notification'] = $message;
}
else
{
    $requete = $requete->getInfosUser($classeur['users_informations_id']);
    $mainMdp = $requete->fetch(PDO::FETCH_ASSOC);

    if (password_verify($mdp, $mainMdp['password']) || password_verify($mdp, $classeur['master'])){
        $message = "Le mot de passe de classeur doit être différent de celui présentement utilisé et de votre mot de passe principal.";
        $_SESSION['Notification'] = $message;
    }
    else{
        $mdp = password_hash($mdp);
        $modif->setInfosClasseur($id, $nom, $mdp);
        $message = "Les modifications ont étés apportés au classeur.";
        $_SESSION['Notification'] = $message;
    }
}
//header("Location: ../listeClasseurs.php");
