<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
include_once "../Classe/encryption.classe.php";
$temporaire = new Requete();
$mdp = new Requete();
$code = new Requete();
$operation = new Requete();
$encryption = new encryption();

$code = $encryption->encrypterInfos($_POST['code']);
$email = $encryption->encrypterInfos($_POST['email']);
$question = $_POST['question'];
$reponse = $_POST['reponse'];

//Vérifie si le email entré est en attente d'activation.
$temporaire = $temporaire->requeteSQLPDO("SELECT email, password, activation FROM users_temporaires WHERE email = :param1", array($email), __FILE__);


if ($temporaire->rowCount() ==1){
    $resultat = $temporaire->fetch(PDO::FETCH_ASSOC);


    if (password_verify($_POST['pass'], $resultat['password'])){
        if($resultat['activation'] == $code){
            if(strlen($question) >= 5 || strlen($reponse) >= 5){
                $question = $encryption->encrypterInfos($question);
                $reponse = $encryption->encrypterInfos($reponse);
                $operation->requeteSQLPDO("INSERT INTO users_informations (email, password, questionSecurite, reponseSecurite) VALUES (:param1, :param2, :param3, :param4)", array($resultat['email'], $resultat['password'], $question, $reponse), __FILE__);
                $operation->requeteSQLPDO("DELETE FROM users_temporaires WHERE email = :param1", array($resultat['email']), __FILE__);
                $message = "Votre compte a été activer.";
                $_SESSION['Notification'] = $message;
                header("Location: ../index.php");
            }
            else{
                $message = "Vous devez saisir une question et une réponse de sécurité avec un minimum de 5 caractères.";
                $_SESSION['Notification'] = $message;
                header("Location: ../activation.php");
            }
        }
        else{
            $message = "Les informations ne sont pas valide.";
            $_SESSION['Notification'] = $message;
            header("Location: ../activation.php");
        }
    }
    else{
        $message = "Les informations ne sont pas valide.";
        $_SESSION['Notification'] = $message;
        header("Location: ../activation.php");
    }
}
else{
    $message = "Les informations ne sont pas valide.";
    $_SESSION['Notification'] = $message;
    header("Location: ../activation.php");
}

