<?php
include_once '../Include/genererSession.include.php';
include_once "../Classe/requeteSQL.classe.php";
include_once "../Classe/encryption.classe.php";
$encryption = new encryption();
$getNom = new Requete();
$valide = "false";

$nom = $encryption->encrypterInfos($_POST['nom']);

//valide l'adresse mail entrée.
if (filter_var($nom, FILTER_SANITIZE_STRING)){
    $getNom = $getNom->requeteSQLPDO("SELECT nom FROM `users_vault` 
                                    INNER JOIN users_informations 
                                    ON users_vault.users_informations_id= users_informations.id 
                                    WHERE nom = :param1 AND email = :param2",
                                    array($nom, $_SESSION['usager']), __FILE__);
    if ($getNom->rowCount()==0)
        $valide = "ok";
    else
        $valide = "Le nom de classeur est déjà utiliser.";
}
else{
    $valide = "Veuillez entrer un nom de classeur valide";
}

echo $valide;
