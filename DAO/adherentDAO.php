<?php
require_once('DAO.php');
require_once('adherent.php');

Class AdherentDAO extends DAO {
    
    public function __construct() {
        parent::__construct();
    }

    public function find($mail) {
        $sql = "SELECT * FROM adherent WHERE email_util= :mail";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':mail' => $mail
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $adherent=null;
        if ($row) {
            $adherent = new Adherent($row);
        }
        
       
        return $adherent;
    }

  
    public function findAll() {
        $sql = "SELECT * FROM adherent,utilisateur WHERE adherent.email_util = utilisateur.email_util"; 

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $adherents = array();

        foreach ($rows as $row) {
            $adherents[] = new Adherent($row);
        }

        return $adherents;
    }


}