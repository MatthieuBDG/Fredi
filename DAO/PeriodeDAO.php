<?php
require_once('DAO.php');
require_once('periode.php');

Class PeriodeDAO extends DAO {
    //Constructeur
    public function __construct() {
        parent::__construct();
    }

    //Nouvelle periode
    public function createPeriode($annee_per, $forfait_km_per, $statut_per) {
        $sql = "INSERT INTO periode (annee_per, forfait_km_per, statut_per) ";
        $sql .= "VALUES (:annee_per, :forfait_km_per, :statut_per)";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':annee_per' => $annee_per,
                ':forfait_km_per' => $forfait_km_per,
                ':statut_per' => $statut_per
            ));
        } catch (PDOException $ex) {
            throw new Exception("Erreur lors de la requête SQL : ".$ex->getMessage());
        }

        header('Location: liste_periode.php');
    }

    //Mets à jour une période
    public function updatePeriode($annee_per, $forfait_km_per, $statut_per) {
        $sql = "UPDATE periode SET forfait_km_per = :forfait_km_per, statut_per = :statut_per WHERE annee_per = :annee_per";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':annee_per' => $annee_per,
                ':forfait_km_per' => $forfait_km_per,
                ':statut_per' => $statut_per
            ));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // return 'La période a été modifié. Retourner à la <a href="liste_periode.php">liste</a>'; 
        header('Location: '.$_SERVER['PHP_SELF'].'?annee_per='.$_GET['annee_per'].'&res=La période a été modifié.');
    }

    //Retourne toutes les periodes
    public function findAll() {
        $sql = "SELECT * FROM periode";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $periodes = array();

        foreach ($rows as $row) {
            $periodes[] = new Periode($row);
        }

        // Retourne un tableau d'objets
        return $periodes;
    }

    //Retourne une période
    public function find($annee_per) {
        $sql = "SELECT * FROM periode WHERE annee_per = :annee_per";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':annee_per' => $annee_per
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // Retourne un tableau
        return new Periode($row);
    }

    public function findPeriodeActive()
    { //retourne la periode active
        $sql = "select * from periode where statut_per = 1";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $periode = null;
        if ($row) { 
            $periode = new Periode($row);
        }
        return $periode;
    }

    public function test(){

        $sql = "SELECT * FROM ligne_de_frais,periode WHERE periode.annee_per = ligne_de_frais.annee_per AND statut_per = 1";
        
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $count = $sth->rowCount(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        
        return $count;
    }
}