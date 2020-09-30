<?php
require_once('DAO.php');
require_once('periode.php');

Class PeriodeDAO extends DAO {
    //Constructeur
    public function __construct() {
        parent::__construct();
    }

    //Nouvelle periode
    public function createPeriode($anne_pere, $forfait_km_per, $statut_per) {
        $sql = "INSERT INTO periode (anne_pere, forfait_km_per, statut_per) ";
        $sql .= "VALUES (:anne_pere, :forfait_km_per, :statut_per)";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':anne_pere' => $anne_pere,
                ':forfait_km_per' => $forfait_km_per,
                ':statut_per' => $statut_per
            ));
        } catch (PDOException $ex) {
            throw new Exception("Erreur lors de la requête SQL : ".$ex->getMessage());
        }

        header('Location: liste_periode.php');
    }

    //Mets à jour une période
    public function updatePeriode($anne_pere, $forfait_km_per, $statut_per) {
        $sql = "UPDATE periode SET forfait_km_per = :forfait_km_per, statut_per = :statut_per WHERE anne_pere = :anne_pere";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':anne_pere' => $anne_pere,
                ':forfait_km_per' => $forfait_km_per,
                ':statut_per' => $statut_per
            ));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // return 'La période a été modifié. Retourner à la <a href="liste_periode.php">liste</a>'; 
        header('Location: '.$_SERVER['PHP_SELF'].'?anne_pere='.$_GET['anne_pere'].'&res=La période a été modifié.');
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
    public function find($anne_pere) {
        $sql = "SELECT * FROM periode WHERE anne_pere = :anne_pere";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':anne_pere' => $anne_pere
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // Retourne un tableau
        return new Periode($row);
    }

    //Desactive une période
    public function desactiverPeriode($anne_pere) {
        $sql = "UPDATE periode SET statut_per = 0 WHERE anne_pere = :anne_pere";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':anne_pere' => $anne_pere
            ));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        return "La période a été désactivé";
    }