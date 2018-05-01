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
        echo "<a class='titre'>" . $encryption->encrypterInfos($classeur['nom'],"d") . "</a>";
        echo '<form name="formClasseur" method="post" action="Redirect/validerClasseur.redirect.php">';
            echo "<input type='hidden' id='classeur' name='classeur' value=' " . $classeur['id'] . "''></input>";
            echo "<button onclick='formClasseur.submit()'>Accèder</button>";
        echo '</form>';

        echo "<form name='formSupprClasseur' method='post' action='suppressionClasseur.php'>";
            echo "<input type='hidden' id='idClasseur' name='nomClasseur' value=' " . $classeur['id'] . "'>";
            echo "<button onclick='formSupprClasseur.submit()'>Supprimer</button>";
        echo "</form>";

        echo "<form name='formModClasseur' method='post' action='modifierClasseur.php'>";
            echo "<input type='hidden' id='idClasseur' name='nomClasseur' value=' " . $classeur['id'] . "'>";
            echo "<button onclick='formModClasseur.submit()'>Modifier</button>";
        echo "</form>";
    echo "</div>";
}