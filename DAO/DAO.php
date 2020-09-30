<?php
class DAO { 
    protected $pdo=null; // Objet de connexion

    /**
     * Constructeur
     */
    public function __construct()
    {
        // On construit le DSN
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        // Création de la connexion
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo("<p>Erreur lors de la connexion : " . $e->getMessage().'<p>');
        }
        $this->pdo = $pdo;
    } // function __construct

    
} // class DAO
