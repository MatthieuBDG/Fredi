<?php
require_once('DAO.php');
require_once('adherent.php');

Class AdherentDAO extends DAO {
    
    public function __construct() {
        parent::__construct();
    }

    public function find($id_adherent) {
        $sql = "SELECT * FROM adherent WHERE id_utilisateur= :id_adherent";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_adherent' => $id_adherent
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
        $sql = "SELECT * FROM adherent"; 

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