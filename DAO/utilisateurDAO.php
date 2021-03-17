<?php
require_once('DAO.php');
require_once('utilisateur.php');

Class utilisateurDAO extends DAO {
    
    public function __construct() {
        parent::__construct();
    }

    public function find($email_util) {
        $sql = "SELECT * FROM utilisateur WHERE email_util= :email_util";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':email_util' => $email_util
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $utilisateur=null;
        if ($row) {
            $utilisateur = new utilisateur($row);
        }
        
       
        return $utilisateur;
    }

  
    public function findAll() {
        $sql = "SELECT * FROM utilisateur"; 
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $utilisateurs = array();

        foreach ($rows as $row) {
            $utilisateurs[] = new utilisateur($row);
        }

        return $utilisateurs;
    }

    public function findUtilisateursAvecLdfPerActive()
    { //retourne les utilisateurs avec au moins une ldf sur la période active
        $sql = "SELECT * from utilisateur 
        WHERE email_util IN (SELECT DISTINCT 
                             email_util 
                             from ligne_de_frais 
                             WHERE annee_per = (SELECT annee_per from periode WHERE statut_per = 1))";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $utilisateurs = array();
        foreach ($rows as $row) { //hydrateur
            $utilisateurs[] = new Utilisateur($row);
        }
        return $utilisateurs;
    }
}