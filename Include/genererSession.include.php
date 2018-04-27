<?php
//Oblige le site à être consulter en HTTPS.
if (!isset($_SERVER["HTTPS"]))
{
    header("location: https://{$_SERVER['SERVER_NAME']}{$_SERVER['PHP_SELF']}");
}
//Paramètres de sécurité pour la session.
ini_set("session.cookie_httponly", "On");
ini_set("session.name", "fullsecure");
ini_set("session.gc_maxlifetime", 10);
ini_set("session.gc_probability", 100);
ini_set("session.gc_divisor", 1);

//Paramètre de la session. Si la session n'est pas créer, l'utilisateur ne peut pas consulter sa base de données. Après 10 minutes d'inactivités,
//la session est supprimer et l'utilisateur est déconnecté
session_name("KeyVault");
session_set_cookie_params(time()+600,"/",null,true,true);
session_start();
session_regenerate_id();