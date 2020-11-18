<?php
require_once('DAO.php');
require_once('ligue.php');

Class ligueDAO extends DAO {
    //Constructeur
    public function __construct() {
        parent::__construct();
    }

    //Nouvelle ligue
    public function createLigue($id_ligue, $lib_ligue, $url_ligue, $contact_ligue, $telephone_ligue, $email_util) {
        $sql = "INSERT INTO ligue (id_ligue, lib_ligue, url_ligue, contact_ligue, telephone_ligue, email_util) ";
        $sql .= "VALUES (:id_ligue, :lib_ligue, :url_ligue, :contact_ligue, :telephone_ligue, :email_util)";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':id_ligue' => $id_ligue,
                ':lib_ligue' => $lib_ligue,
                ':url_ligue' => $url_ligue,
                ':contact_ligue' => $contact_ligue,
                ':telephone_ligue' => $telephone_ligue,
                ':email_util' => $email_util
            ));
        } catch (PDOException $ex) {
            throw new Exception("Erreur lors de la requête SQL : ".$ex->getMessage());
        }

        header('Location: liste_ligue.php');
    }

    //Mets à jour une ligue
    public function updateligue($id_ligue, $lib_ligue, $url_ligue, $contact_ligue, $telephone_ligue, $email_util) {
        $sql = "UPDATE ligue 
        SET 
        id_ligue = :id_ligue,
        lib_ligue = :lib_ligue,
        url_ligue = :url_ligue,
        contact_ligue = :contact_ligue,
        telephone_ligue = :telephone_ligue,
        email_util = :email_util
        WHERE id_ligue = :id_ligue";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
              ':id_ligue' => $id_ligue,
              ':lib_ligue' => $lib_ligue,
              ':url_ligue' => $url_ligue,
              ':contact_ligue' => $contact_ligue,
              ':telephone_ligue' => $telephone_ligue,
              ':email_util' => $email_util
            ));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        // return 'La ligue a été modifié. Retourner à la <a href="liste_ligue.php">liste</a>'; 
        header('Location: '.$_SERVER['PHP_SELF'].'?id_ligue='.$_GET['id_ligue'].'&res=La ligue a été modifiée.');
    }

    //Retourne toutes les ligues
    public function findAll() {
        $sql = "SELECT * FROM ligue";

        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute();
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }

        $ligues = array();

        foreach ($rows as $row) {
            $ligues[] = new ligue($row);
        }

        // Retourne un tableau d'objets
        return $ligues;
    }

}