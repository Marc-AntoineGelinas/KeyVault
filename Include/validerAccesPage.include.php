<?php
//Valide si la session "usager" est créer. Sinon, l'accès à la page n'est pas autoriser.
if (!isset($_SESSION['usager'])){
    header("Location: connexion.php");
}