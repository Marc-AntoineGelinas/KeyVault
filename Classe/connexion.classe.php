<?php

include_once '../Include/config.include.php';
//Gère la connection à la base de données. Les paramètres sont dans config.include.php
class Connexion extends PDO {

    public function __construct() {
        try {
            parent::__construct(HOTE,USER,PASS);
        } catch (Exception $e) {
            echo "<p>".$e->getMessage()."</p>";
        }
    }
}