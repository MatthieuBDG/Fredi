<?php
require_once('DAO.php');
require_once('controleur.php');

Class controleurDAO extends DAO {
    //Constructeur
    public function __construct() {
        parent::__construct();
    }

    //Nouvelle controleur
    public function createControleur($id_utilisateur, $Matricule_CONT) {
        $sql = "INSERT INTO controleur (id_utilisateur,  Matricule_CONT) ";
        $sql .= "VALUES (:id_utilisateur,:Matricule_CONT)";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_utilisateur' => $id_utilisateur,
                ':Matricule_CONT' => $Matricule_CONT
            ));
        } catch (PDOException $ex) {
            throw new Exception("Erreur lors de la requête SQL : ".$ex->getMessage());
        }

        header('Location: liste_controleur.php');
    }

    //Mets à jour une période
    public function updateControleur($id_utilisateur,  $Matricule_CONT) {
        $sql = "UPDATE controleur SET Matricule_CONT = :Matricule_CONT WHERE id_utilisateur = :id_utilisateur";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_utilisateur' => $id_utilisateur,
                ':Matricule_CONT' => $Matricule_CONT
            ));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

    }

    //Retourne toutes les controleurs
    public function findAll() {
        $sql = "SELECT * FROM controleur";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $controleurs = array();

        foreach ($rows as $row) {
            $controleurs[] = new Controleur($row);
        }

        // Retourne un tableau d'objets
        return $controleurs;
    

        // Retourne un tableau
        return new Controleur($row);

    }
}