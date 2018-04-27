<?php
//Valide si la session "idClasseur" est créer. Sinon, l'accès à la page n'est pas autoriser.
if (!isset($_SESSION['idClasseur'])){
    header("Location: listeClasseurs.php");
}