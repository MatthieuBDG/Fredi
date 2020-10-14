<?php
require_once('DAO/user.php');
require_once('init.php');
require_once('DAO/periodeDAO.php');
session_start();

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    //Verifie si il s'agit d'un admin
    if($user->getTypeUser() == 2 || $user->getTypeUser() == 3) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}

//Collection des periodes
$periodes = new PeriodeDAO();
$rows = $periodes->findAll();

//Permet de desactiver une periode
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);
?>

