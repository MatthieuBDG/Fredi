<?php
require_once('DAO.php');
require_once('ligne_de_frais.php');

Class Ligne_de_fraisDAO extends DAO {
    //Constructeur
    public function __construct() {
        parent::__construct();
    }

    //Retourne toutes les ligne_de_frais
    public function findAll() {
        $sql = "SELECT * FROM ligne_de_frais";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $ligne_de_frais = array();

        foreach ($rows as $row) {
            $ligne_de_frais[] = new Ligne_de_frais($row);
        }

        // Retourne un tableau d'objets
        return $ligne_de_frais;
    }

    //Retourne une période
    public function find($id_ldf) {
        $sql = "SELECT * FROM ligne_de_frais WHERE id_ldf = :id_ldf";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_ldf' => $id_ldf
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // Retourne un tableau
        return new Ligne_de_frais($row);
    }

   
}