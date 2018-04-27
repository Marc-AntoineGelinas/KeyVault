<?php
include_once "../Include/genererSession.include.php";
include_once "../Classe/requeteSQL.classe.php";
include_once "../Include/config.include.php";
$verification = new requete();
$idClasseur = $_POST['classeur'];


$verification = $verification->requeteSQLPDO("SELECT users_vault.id, users_vault.master
FROM users_vault
INNER JOIN users_informations
ON users_vault.users_informations_id = users_informations.id
WHERE users_informations.email = :param1 AND users_vault.id = :param2", array($_SESSION['usager'], $idClasseur));

if ($verification->rowCount() != 1){
    $message = "Ce classeur ne vous appartient pas.";
    header("Location: ../listeClasseurs.php");
}
else
{
    $classeur = $verification->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idClasseur'] = $classeur['id'];
    if ($classeur['master'] == null){
        header("Location: ../classeur.php");
    }
    else{
        ?>
        <h1>Entrer le mot de passe du classeur</h1>
        <form  name="formLogin" method="post" action="validerMDPClasseur.redirect.php">
            <input type="password" name="pass" id="pass" placeholder="Mot de passe">
        </form>
        <?php
    }
}

