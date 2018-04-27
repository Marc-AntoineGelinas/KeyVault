<?php
include_once '../Include/genererSession.include.php';
include_once "../Classe/requeteSQL.classe.php";
include_once "../Classe/ajouterLogs.classe.php";
include_once "../Classe/encryption.classe.php";
$usager = new Requete();
$mdp = new Requete();
$encryption = new encryption();

$email = $encryption->encrypterInfos($_POST['email']);

//Va chercher dans la base de données si le compte utilisateur et le mot de passe concorde/existe
$usager = $usager->requeteSQLPDO("SELECT email FROM users_informations WHERE email = :param1", array($email), __FILE__);

//Vérifie si les entrées sont valide. Si oui, procède au site, sinon envoie un message d'erreur.
if ($usager->rowcount() == 1)
{
    $mdp = $mdp->requeteSQLPDO("SELECT password FROM users_informations WHERE email = :param1", array($email), __FILE__);
    $resultat = $mdp->fetch(PDO::FETCH_ASSOC);

    //Vérifie si le mot de passe entrée concorde avec celui de la base de données
    if (password_verify($_POST['pass'], $resultat['password']))
    {
        //Place le e-mail dans un cookie qui va servir à la validation d'acces aux pages.
        $nom = $usager->fetchall(PDO::FETCH_COLUMN, 0);
        $_SESSION['usager'] = $nom['0'];
        $ajoutLog = new AjouterLog("logConnexionReussite.log", "Connection réussite : " . $_POST['email'], __FILE__);
        header("Location: ../listeClasseurs.php");
    }
    else
    {
        $message = "Les informations ne sont pas valide.";
        $_SESSION['Notification'] = $message;
        $ajoutLog = new AjouterLog("logConnexionEchoue.log", "Mot de passe invalide : " . $_POST['email'], __FILE__);
        header("Location: ../index.php");
    }
}
else
{
    $message = "Les informations ne sont pas valide.";
    $_SESSION['Notification'] = $message;
    $ajoutLog = new AjouterLog("logConnexionEchoue.log", "L'usager n'existe pas : " . $_POST['email'], __FILE__);
    header("Location: ../index.php");
}