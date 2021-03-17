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
/*
$host_name = 'localhost';
$database = 'apsixpac_2siog2';
$user_name = 'apsixpac';
$password = 'afmNWCytYQ2K3v';
$dbh = null;

try {
  $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
} catch (PDOException $e) {
  echo "Erreur!: " . $e->getMessage() . "<br/>";
  die();
}*/
?>