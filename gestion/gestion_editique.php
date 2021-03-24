<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>Éditique</title>
</head>
<body>
</div>
<?php
require_once('../init.php');
include '../connexion_dbh.php';
  $userDAO= new UtilisateurDAO;
  $usersPerAct = $userDAO->findUtilisateursAvecLdfPerActive(); // renvoie les utilisateurs qui ont au moins une ligne de frais sur la periode active
?>
<div class="menu">
    <ul>
    <li><a  href="../index">Accueil</a></li>
    <?php if(!isset($_SESSION['email_util'])) { ?>
    <li><a class="active" href="../connexion">Connexion</a></li>
    <?php }else{ ?>
    <li><a href="../deconnexion">Deconnexion</a></li>
    <?php } ?>
    <li><a href="../#contact">Contact</a></li>
    <li><a  href="../#about">About</a></li>
    <?php if(isset($_SESSION['email_util'])) { ?>
    <li><a href="../profil?mail=<?php echo $_SESSION['email_util'] ?>"><?php echo $_SESSION['prenom_util']; ?></a></li>
    <?php } ?>
    </ul>     
    </div>
    <br><br><br><br><br>
<center>
    

<h2>Liste des utilisateurs avec des lignes de frais sur la période active </h2>
<table><tr><th>Mail</th><th>Nom</th><th colspan='2'>Actions</th></tr>

<?php
  foreach ($usersPerAct as $user) {
    echo "<tr><td>".$user->get_email_util()."</td>";
    echo "<td>".$user->get_nom_util()." ".$user->get_prenom_util()."</td>";
    echo "<td><a href=cerfaPDF.php?id=".$user->get_email_util().">CERFA</a></td>";
    echo "<td><a href=noteDeFraisPDF.php?id=".$user->get_email_util().">Note de Frais</a></td></tr>";
  }
?>
</table>

<?php 
  $ligueDAO = new LigueDAO;
  $liguesAct = $ligueDAO->getLigueAct();
?>

<h2> Liste des ligues avec des lignes de frais</h2>
<table><tr><th>Ligue</th><th>Période</th><th>Actions</th></tr>
<?php
  foreach ($liguesAct as $ligueAct){
    $periodes = $ligueDAO->getPeriodesActByLigue($ligueAct['id_ligue']);
    foreach ($periodes as $periode) {
        echo '<tr><td>'.$ligueAct['lib_ligue'].'</td>';
        echo '<td>'.$periode['annee_per'].'</td>';
        echo "<td><a href=cumul_de_frais_pdf.php?id=".$ligueAct['id_ligue']."&per=".$periode['annee_per'].">Note de Frais</a></td></tr>";

    }

  }
?>
</center>
</body>
</html>