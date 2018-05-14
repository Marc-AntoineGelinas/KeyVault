<?php
include_once '../Include/genererSession.include.php';

if (!isset($_SESSION['usager'])){
    header("Location: ../connexion.php");
}
else{
    header("Location: ../listeClasseurs.php");
}