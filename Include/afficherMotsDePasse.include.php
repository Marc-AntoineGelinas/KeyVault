<?php
include_once "Classe/gestionBd.classe.php";
include_once "Include/config.include.php";
include_once 'Include/genererSession.include.php';
include_once "../Classe/encryption.classe.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$requete = new Gestionbd();
$encryption = new encryption();

$requete = $requete->getListeMotsDePasse($idClasseur, $_SESSION['usager']);
$resultat = $requete->fetchall(PDO::FETCH_ASSOC);

echo "<h1>" . $encryption->encrypterInfos($resultat[0]['nomVault'], "d") . "</h1   >";

foreach($resultat as $motsDePasse){
    echo "<div>";
    echo "<label>" . $encryption->encrypterInfos($motsDePasse['nomMdp'], 'd');
    echo "<div>";
    echo "<input type='text' name⁼'mdp' id='mdp' size='32' value='" . $encryption->encrypterInfos($motsDePasse['passwordMdp'], 'd') . "'></input>";
    echo "<form name='formSupprMdp' method='post' action='suppressionMdp.php'>";
    echo "<input type='hidden' id='idMdp' name='nomMdp' value=' " . $motsDePasse['idMdp'] . "'>";
    echo "<input type='submit' value='Supprimer'>";
    echo "</form>";
    echo "<form name='formModMdp' method='post' action='modifierMotDePasse.php'>";
    echo "<input type='hidden' id='idMdp' name='idMdp' value=' " . $motsDePasse['idMdp'] . "'>";
    echo "<input type='submit' value='Modifier'>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "<br/>";
}
?>