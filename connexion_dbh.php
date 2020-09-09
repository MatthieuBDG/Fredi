<?php
// 
//connexion_dbh.php
//
session_start();

$db = 'mysql:dbname=fredi;host=localhost';
$db_user = 'root';
$db_password = '';
try {
    $dbh = new PDO($db,$db_user,$db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); //connexion base de données
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die ($ex->getMessage());
}


?>