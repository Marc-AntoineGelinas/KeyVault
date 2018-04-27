<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Classe/encryption.classe.php";
$verification = new requete();
$encryption = new encryption();

$email = $encryption->encrypterInfos($_POST['email']);


$verification = $verification->requeteSQLPDO("
SELECT id ,email, recovery
FROM users_informations
WHERE email=:param1", array($email), __FILE__);

if ($verification->rowCount() == 1){
    $resultat = $verification->fetch(PDO::FETCH_ASSOC);
    if ($resultat['recovery'] == null) {
        $_SESSION['Verification'] = $resultat['id'];
        header("Location: ../questionSecurite.php");
    }
    else{
        $message = "L'adresse de réinitialisation vous a déjà été envoyée à votre e-mail";
        $_SESSION['Notification'] = $message;
        header("Location: ../index.php");
    }
}
else
{
    $message = "Cette adresse email n'est pas dans la base de données.";
    $_SESSION['Notification'] = $message;
    header("Location: ../index.php");
}

