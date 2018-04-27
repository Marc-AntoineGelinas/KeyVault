<?php
include_once '../Include/genererSession.include.php';
include_once "../Classe/requeteSQL.classe.php";
include_once "../Classe/encryption.classe.php";
$encryption = new encryption();
$getEmail = new Requete();
$valide = "false";


//valide l'adresse mail entrée.
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $email = $encryption->encrypterInfos($_POST['email']);
    $getEmail = $getEmail->requeteSQLPDO("SELECT email FROM users_informations WHERE email = :param1", array($email), __FILE__);
    if ($getEmail->rowCount()==0)
        $valide = "ok";
    else
        $valide = "L'adresse e-mail est déjà utilisée.";
}
else{
    $valide = "Veuillez entrer une adresse valide";
}


echo $valide;
