<?php

include_once 'Include/config.include.php';
include_once "requeteSQL.classe.php";
//Gère des opérations sur la base de données
class Gestionbd  {

    //Retourne la liste des classeurs
    public function getListeClasseur($email){
        $requete = new requete();

        $requete = $requete->requeteSQLPDO(
            "SELECT users_vault.id, nom
                  FROM users_vault
                  INNER JOIN users_informations
                  ON users_vault.users_informations_id = users_informations.id
                  WHERE users_informations.email = :param1", array($email), __FILE__);

        return $requete;
    }

    public function getListeMotsDePasse($idClasseur, $email){
        $requete = new requete();

        $requete = $requete->requeteSQLPDO(
            "SELECT users_passwords.id AS idMdp,
                         users_passwords.nom AS nomMdp,
                         users_passwords.password AS passwordMdp,
                         users_vault.nom AS nomVault
                  FROM users_passwords
                  INNER JOIN users_informations
                  ON users_passwords.users_vault_users_informations_id = users_informations.id
                  INNER JOIN users_vault
                  ON users_passwords.users_vault_id = users_vault.id
                  WHERE users_passwords.users_vault_id = :param1  
                        AND users_informations.email = :param2",
                  array($idClasseur, $email), __FILE__);
        return $requete;
    }

    public function getInfosMotDePasse($idMdp){
        $requete = new requete();

        $requete = $requete->requeteSQLPDO(
            "SELECT *
                  FROM users_passwords
                  WHERE id = :param1",
            array($idMdp), __FILE__);

        return $requete;
    }

    public function getInfosUser($idUser){
        $requete = new requete();

        $requete = $requete->requeteSQLPDO(
            "SELECT *
                  FROM users_informations
                  WHERE id = :param1",
            array($idUser), __FILE__);

        return $requete;
    }

    public function setInfosUser($id, $password, $question, $reponse, $recovery){
        $requete = new requete();

        $requete->requeteSQLPDO(
            "UPDATE users_informations 
                  SET password=:param2,questionSecurite=:param3,reponseSecurite=:param4,recovery=:param5 
                  WHERE id=:param1",
            array($id, $password, $question, $reponse, $recovery), __FILE__);
    }

    public function getInfosUserV2($recovery){
        $requete = new requete();

        $requete = $requete->requeteSQLPDO(
            "SELECT *
                  FROM users_informations
                  WHERE recovery = :param1",
            array($recovery), __FILE__);

        return $requete;
    }

    public function getInfosClasseur($idClasseur){
        $requete = new requete();

        $requete = $requete->requeteSQLPDO(
            "SELECT *
                  FROM users_vault
                  WHERE id = :param1",
            array($idClasseur), __FILE__);

        return $requete;
    }

    public function setInfosMotDePasse($idMdp, $nom, $password, $idClasseur){
        $requete = new requete();

        $requete->requeteSQLPDO(
            "UPDATE users_passwords 
                  SET nom=:param2,password=:param3 
                  WHERE users_vault_id= :param4
                  AND id=:param1",
            array($idMdp, $nom, $password, $idClasseur), __FILE__);
    }

    public function deleteMotDePasse($idMdp){
        $requete = new requete();

        $requete->requeteSQLPDO(
            "DELETE FROM `users_passwords` 
                  WHERE id=:param1",
            array($idMdp), __FILE__);
    }

    public function clearClasseur($idClasseur){
        $requete = new requete();

        $requete->requeteSQLPDO(
            "DELETE FROM `users_passwords` 
                  WHERE users_vault_id=:param1",
            array($idClasseur), __FILE__);
    }

    public function deleteClasseur($idClasseur){
        $requete = new requete();

        $requete->requeteSQLPDO(
            "DELETE FROM `users_vault` 
                  WHERE id=:param1",
            array($idClasseur), __FILE__);
    }

    public function setInfosClasseur($id, $nom, $master){
        $requete = new requete();

        $requete->requeteSQLPDO(
            "UPDATE users_vault 
                  SET nom=:param2, master=:param3 
                  WHERE id=:param1",array($id, $nom, $master), __FILE__);
    }

}