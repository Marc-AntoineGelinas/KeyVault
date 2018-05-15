<?php
include_once "../Include/genererSession.include.php";
if (isset($_SESSION["usager"])){
    session_start();
    session_destroy();
    unset($_SESSION["usager"]);
    header('location: ../index.php');
}