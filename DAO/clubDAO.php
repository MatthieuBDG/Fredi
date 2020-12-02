<?php
require_once('DAO.php');
require_once('club.php');

Class ClubDAO extends DAO {
    //Constructeur
    public function __construct(){
        parent::__construct();
    }

    //Retourne un club en particulier
    public function find($id_club) {
        $sql = "SELECT * FROM club WHERE id_club=:id_club";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_club' => $id_club
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $club=null;
        if ($row) {
            $club = new Club($row);
        }
        
        // Retourne l'objet métier
        return $club;
    }

    //Retourne toutes les clubs
    public function findAll() {
        $sql = "SELECT * FROM club"; //A modifier

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $club = array();

        foreach ($rows as $row) {
            $club[] = new Club($row);
        }

        // Retourne un tableau d'objets
        return $club;
    }
}
?>