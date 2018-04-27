<?php
include_once "Classe/gestionBd.classe.php";
include_once "Include/config.include.php";
include_once 'Include/genererSession.include.php';
include_once "Classe/encryption.classe.php";

$encryption = new encryption();
$requete = new Gestionbd();

$requete = $requete->getListeClasseur($_SESSION['usager']);
$resultat = $requete->fetchall(PDO::FETCH_ASSOC);

foreach($resultat as $classeur){
    echo "<div>";
        echo "<label>" . $encryption->encrypterInfos($classeur['nom'],"d");
        echo '<form name="formClasseur" method="post" action="Redirect/validerClasseur.redirect.php">';
            echo "<input type='hidden' id='classeur' name='classeur' value=' " . $classeur['id'] . "''></input>";
            echo "<input type='submit' onclick='formClasseur.submit()' value='Accéder''></input>";
        echo '</form>';
        echo "<form name='formSupprClasseur' method='post' action='suppressionClasseur.php'>";
            echo "<input type='hidden' id='idClasseur' name='nomClasseur' value=' " . $classeur['id'] . "'>";
            echo "<input type='submit' value='Supprimer'>";
        echo "</form>";
        echo "<form name='formModClasseur' method='post' action='modifierClasseur.php'>";
            echo "<input type='hidden' id='idClasseur' name='nomClasseur' value=' " . $classeur['id'] . "'>";
            echo "<input type='submit' value='Modifier'>";
        echo "</form>";
    echo "</div>";
}