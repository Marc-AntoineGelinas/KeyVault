<?php
include_once 'connexion.classe.php';
include_once 'ajouterLogs.classe.php';

//Classe qui effectue toutes les requetes SQL, valide les parametres envoyés et documente toutes les requêtes.
class requete{
    public $verification;
    public $con;

    //Requète avec paramètres
    function requeteSQLPDO($stmt, $parametres, $file){

        if (filter_var_array($parametres, FILTER_SANITIZE_STRING)){
            $con = new Connexion();
            $x = 1;
            $verification = $con->prepare($stmt);
            foreach ($parametres as $param){
                $verification->bindValue(':param' . $x, $param);
                $x++;
            }
            $verification->execute();

            new AjouterLog("../logRequeteSql.log", $stmt . "\n" . implode(' ', $parametres), $file);
            return $verification;
        }
    }

    //Requête sans paramètre
    function requeteSansParam($stmt, $file) {
        $con = new Connexion();
        $verification = $con->prepare($stmt);
        $verification->execute();
        new AjouterLog("../Logs/logRequeteSql.log", $stmt, $file);
        return $verification;
    }
}