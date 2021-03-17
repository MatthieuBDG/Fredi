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
    function find($id){ //retourne contenu de la ligue avec l'id
        $sql = "select * from ligue where id_ligue= :id";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ":id" => $id
            ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
          } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
          }
          $ligue = null;
          if ($row) { //hydrateur
            $ligue = new Ligue($row);
          } 
          return $ligue;
        } 
        public function cumulFrais($idligue, $annee)
        {
            $sql = "SELECT `lib_club`,`motif_de_frais`.`lib_mdf`, SUM(`total_ldf`) AS 'total'
            FROM `ligue`,`club`,`adherent`,`ligne_de_frais`,`motif_de_frais`,`periode`
            WHERE`ligue`.`id_ligue`=`club`.`id_ligue`
            AND `club`.`id_club`=`adherent`.`id_club`
            AND `adherent`.`email_util`=`ligne_de_frais`.`email_util`
            AND`ligne_de_frais`.`id_mdf`=`motif_de_frais`.`id_mdf`
            AND `ligne_de_frais`.`annee_per`=`periode`.`annee_per`
            AND `ligue`.`id_ligue`= :ligue
            AND `periode`.`annee_per`= :annee
            GROUP BY  `motif_de_frais`.`id_mdf`,`club`.`id_club`
            ORDER BY `club`.`lib_club`,`motif_de_frais`.`lib_mdf`";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                ":ligue" => $idligue,
                ":annee" => $annee
            ));
            $rows=$sth->fetchALL(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $rows;
        }
        public function getLigueAct()
        {
            $sql = "SELECT DISTINCT L.id_ligue, lib_ligue
            FROM ligne_de_frais Ldf, adherent A, club C, ligue L
            WHERE Ldf.email_util=A.email_util
            AND A.id_club=C.id_club
            AND C.id_ligue=L.id_ligue";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute();
            $rows=$sth->fetchALL(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $rows;
        }
        public function getPeriodesActByLigue($idligue)
        {
            $sql = "SELECT DISTINCT annee_per
            FROM ligne_de_frais L, adherent A, club C
            WHERE L.email_util=A.email_util
            AND A.id_club=C.id_club
            AND C.id_ligue = :idligue";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                ":idligue" => $idligue
            ));
            $rows=$sth->fetchALL(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
            }
            return $rows;
        }

}