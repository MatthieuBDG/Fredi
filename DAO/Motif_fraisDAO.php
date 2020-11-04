<?php
require_once('DAO.php');
require_once('Motif_frais.php');

Class Motif_fraisDAO extends DAO {
    //Constructeur
    public function __construct() {
        parent::__construct();
    }

    //Retourne toutes les motif_frais
    public function findAll() {
        $sql = "SELECT * FROM motif_de_frais";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $motif_frais = array();

        foreach ($rows as $row) {
            $motif_frais[] = new Motif_frais($row);
        }

        // Retourne un tableau d'objets
        return $motif_frais;
    }

    //Retourne une période
    public function find($id_mdf) {
        $sql = "SELECT * FROM motif_de_frais WHERE id_mdf = :id_mdf";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_mdf' => $id_mdf
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // Retourne un tableau
        return new Motif_frais($row);
    }

   
}