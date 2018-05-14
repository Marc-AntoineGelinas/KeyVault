<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
$id = new Requete();
$ajout = new Requete();
$encryption = new encryption();
$mdp = filter_var($_POST['appercu'], FILTER_SANITIZE_STRING);
$nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
$idClasseur = $_POST['idClasseur'];



if (strlen($mdp) == 0 || strlen($nom) == 0){
    $message = "Le mot de passe et le nom ne peuvent pas être vide.";
    $_SESSION['Notification'] = $message;
   header("Location: ../ajouterMotDePasse.php");
   die();
} else if (strlen($mdp) < 10 || strlen($mdp) > 32){
    $message = "Le mot de passe doit contenir entre 10 et 32 caractères.";
    $_SESSION['Notification'] = $message;
    header("Location: ../ajouterMotDePasse.php");
    die();
} else if (strlen($nom) < 1 || strlen($nom) > 255){
    $message = "Le nom doit contenir entre 1 et 255 caractères.";
    $_SESSION['Notification'] = $message;
    header("Location: ../ajouterMotDePasse.php");
    die();
}
else
{
    $mdp = $encryption->encrypterInfos($mdp);
    $nom = $encryption->encrypterInfos($nom);
}

$id = $id->requeteSQLPDO("SELECT id FROM users_informations WHERE email = :param1", array($_SESSION['usager']), __FILE__);

if ($id->rowCount() ==1){
    $resultatId = $id->fetch(PDO::FETCH_ASSOC);
    $ajout->requeteSQLPDO("INSERT INTO `users_passwords`(`nom`, `password`, `users_vault_id`, `users_vault_users_informations_id`)
                                VALUES (:param1, :param2, :param3, :param4)",
        array($nom, $mdp, $idClasseur, $resultatId['id']), __FILE__);

    $message = "Le mot de passe a été ajouté";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
}
else {
    $message = "Une erreur est survenu... Veuillez ré-essayer.";
    $_SESSION['Notification'] = $message;
    header("Location : ../listeClasseurs.php");
}
