<?php
include ("../init.php");

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
    $sql= "UPDATE utilisateur SET statut_util = 1 WHERE email_util='".$_GET['email_util']."'";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
     }
    echo "<p>L'utilisateur a bien été désactivé</p>";
    // header("location:gestion_utilisateur.php");
?>