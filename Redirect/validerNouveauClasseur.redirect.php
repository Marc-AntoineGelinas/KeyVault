<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
$requete = new Requete();
$id = new requete();
$ajout = new Requete();
$encryption = new encryption();
$mdp = $_POST['Pass'];
$nom = $encryption->encrypterInfos(filter_var($_POST['Nom'], FILTER_SANITIZE_STRING));

if (strlen($mdp) == 0){
    $mdp = null;
}
else
{
   $requete = $requete->requeteSQLPDO("SELECT password FROM users_informations WHERE email =:param1", array($_SESSION['usager']), __FILE__);
   $mainMdp = $requete->fetch(PDO::FETCH_ASSOC);
   if (password_verify($mdp, $mainMdp['password'])){
       $message = "Le mot de passe de classeur ne doit pas être identique à votre mot de passe principal.";
       $_SESSION['Notification'] = $message;
       header("Location: ../listeClasseurs.php");
       die();
   }
   else{
       $mdp = password_hash($mdp, PASSWORD_DEFAULT);
   }
}

$id = $id->requeteSQLPDO("SELECT id FROM users_informations WHERE email = :param1", array($_SESSION['usager']), __FILE__);

if ($id->rowCount() ==1){
    $resultatId = $id->fetch(PDO::FETCH_ASSOC);
    $ajout->requeteSQLPDO("INSERT INTO users_vault (nom, master, users_informations_id)
                                VALUES (:param1, :param2, :param3)",
                                array($nom, $mdp, $resultatId['id']), __FILE__);
    $message = "Le classeur a été créé";
    $_SESSION['Notification'] = $message;
    header("Location: ../listeClasseurs.php");
}
else {
        $message = "Une erreur est survenu... Veuillez ré-essayer.";
        $_SESSION['Notification'] = $message;
        header("Location : ../nouveauCompte.php");
    }
