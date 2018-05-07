<?php
include_once "Classe/gestionBd.classe.php";
include_once "Include/config.include.php";
include_once 'Include/genererSession.include.php';
include_once "../Classe/encryption.classe.php";

$requete = new Gestionbd();
$encryption = new encryption();

$requete = $requete->getListeMotsDePasse($idClasseur, $_SESSION['usager']);
$resultat = $requete->fetchall(PDO::FETCH_ASSOC);

echo "<a class='titre'>" . $encryption->encrypterInfos($resultat[0]['nomVault'], "d") . "</a   >";

foreach($resultat as $motsDePasse){
    echo "<div>";
        echo "<p class='titre'>" . $encryption->encrypterInfos($motsDePasse['nomMdp'], 'd') . "</p>";
            echo "<input type='text' name⁼'mdp' id='mdp' size='32' value='" . $encryption->encrypterInfos($motsDePasse['passwordMdp'], 'd') . "'></input>";

            echo "<form name='formSupprMdp' method='post' action='suppressionMdp.php'>";
                echo "<input type='hidden' id='idMdp' name='nomMdp' value=' " . $motsDePasse['idMdp'] . "'>";
                echo "<button onclick='formSupprMdp.submit()'>Supprimer</button>";
            echo "</form>";

            echo "<form name='formModMdp' method='post' action='modifierMotDePasse.php'>";
                echo "<input type='hidden' id='idMdp' name='idMdp' value=' " . $motsDePasse['idMdp'] . "'>";
                echo "<button onclick='formModMdp.submit()'>Modifier</button>";
            echo "</form>";
    echo "</div>";
}
?>