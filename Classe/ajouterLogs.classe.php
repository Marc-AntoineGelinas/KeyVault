<?php
//Documente les entrées dans les logs
class AjouterLog{
    public function __construct($location, $message, $script) {
        $serverTime = date("h:i:sa");
        $serverDate = date("d/m/Y");
        $adresseIp = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $separation = "----------------------------------------------------------------";
        file_put_contents("../Logs/" . $location,
        $message . "\n"
        . basename($script) . "\n"
        . "Adresse ip : " . $adresseIp . "\n"
        . "Date : " . $serverDate . "\n"
        . "Heure : " . $serverTime . "\n"
        . "Plateforme : " . $browser . "\n"
        . $separation . "\n", FILE_APPEND);
    }
}