<?php
include_once '../Include/genererSession.include.php';
include_once "../Classe/requeteSQL.classe.php";
include_once "../Classe/ajouterLogs.classe.php";
include_once "../Classe/encryption.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$requete = new Requete();
$encryption = new encryption();
$mdp = $_POST['pass'];

//Va chercher le mot de passe "master" du classeur
$requete = $requete->requeteSQLPDO("SELECT master FROM users_vault WHERE id = :param1", array($_SESSION["idClasseur"]), __FILE__);

//Vérifie si les entrées sont valide. Si oui, procède au site, sinon envoie un message d'erreur.
if ($requete->rowcount() == 1)
{
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    //Vérifie si le mot de passe entrée concorde avec celui de la base de données
    if (password_verify($mdp, $resultat['master']))
    {
        //Connecte au classeur
        $ajoutLog = new AjouterLog("logConnexionReussite.log", "Connection réussite classeur : " . $_SESSION["idClasseur"], __FILE__);
        header("Location: ../modifierClasseur.php");
    }
    else
    {
        $message = "Mot de passe invalide";
        $_SESSION['Notification'] = $message;
        unset($_SESSION['idClasseur']);
        $ajoutLog = new AjouterLog("logConnexionEchoue.log", "Mot de passe invalide : " .$mdp, __FILE__);
        header("Location: ../listeClasseurs.php");
    }
}
else
{
    $message = "Classeur introuvable";
    $_SESSION['Notification'] = $message;
    unset($_SESSION['idClasseur']);
    $ajoutLog = new AjouterLog("logConnexionEchoue.log", "Le classeur est introuvable : " . $_SESSION["idClasseur"], __FILE__);
//    header("Location: ../listeClasseurs.php");
}