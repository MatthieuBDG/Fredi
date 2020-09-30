<?php
include ("init.php");

$dsn = 'mysql:host=localhost;dbname=fredi'; // contient le nom du serveur et de la base
    $user = 'root';
    $password = '';
    try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>
    "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
    }
    $sql= "DELETE FROM adherent WHERE lic_adh='".$_GET['lic_adh']."'";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
     }
    header("location:gestion_utilisateur.php");
?>