
<?php
include '../connexion_dbh.php';
include '../init.php';

if($_SESSION['id_type_util'] == 1){
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>Gestion utilisateurs</title>
</head>

<body>
<div class="menu">
    <ul>
    <li><a  href="index">Accueil</a></li>
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
<?php
$dao = new utilisateurDAO();
$utilisateurs = $dao->findAll(); 

$dao2 = new adherentDAO();
$adherents = $dao2->findAll();

$choixutil = isset($_GET['choixutil']) ? $_GET['choixutil']: null ;
?>
<br><br><br><br><br>

<center>
<p><a class='lien' href="../ajouter">Ajout d'utilisateurs</a></p>
<h1>--Choissisez un type d'utilisateur--</h1>
<p><a href="gestion_utilisateur.php">Liste de tous les utilisateurs</a></p>
<p><a href="gestion_utilisateur.php?choixutil=1">Administrateur</a></p>
<p><a href="gestion_utilisateur.php?choixutil=2">Contrôleur</a></p>
<p><a href="gestion_utilisateur.php?choixutil=3">Adhérent</a></p>

<?php

if ($choixutil === '1') { ?>
  <table>
  <tr><th>email</th><th>Nom</th><th>Prenom</th><th>Profil</th><th>Modifier</th><th>Supprimer</th></tr>
  <?php
    foreach ($utilisateurs as $utilisateur) {
      if($utilisateur->get_statut_util() == 0){
        if($utilisateur->get_matricule_cont() == 0){
          if($utilisateur->get_id_type_util() == 1){
          echo "<tr>";
          echo "<td>".$utilisateur->get_email_util()."</td>";
          echo "<td>".$utilisateur->get_nom_util()."</td>";
          echo "<td>".$utilisateur->get_prenom_util()."</td>";
          echo "<td>".$utilisateur->get_id_type_util()."</td>";
          echo "<td><a href='modification_utilisateur?email=".$utilisateur->get_email_util()."'>modifier</a></td>";
          echo "<td><a href='désactiver_utilisateur.php?email_util=".$utilisateur->get_email_util()."'>Supprimer</td>";
          echo "</tr>";
          }
        }
      }
  }
} else if($choixutil === '2') { ?>
  <table>
  <tr><th>email</th><th>Nom</th><th>Prenom</th><th>Profil</th><th>Matricule</th><th>Modifier</th><th>Supprimer</th></tr>
  <?php
    foreach ($utilisateurs as $utilisateur) {
      if($utilisateur->get_statut_util() == 0){
        if($utilisateur->get_matricule_cont() != 0){
            echo "<tr>";
            echo "<td>".$utilisateur->get_email_util()."</td>";
            echo "<td>".$utilisateur->get_nom_util()."</td>";
            echo "<td>".$utilisateur->get_prenom_util()."</td>";
            echo "<td>".$utilisateur->get_id_type_util()."</td>";
            echo "<td>".$utilisateur->get_matricule_cont()."</td>";
            echo "<td><a href='modification_utilisateur?email=".$utilisateur->get_email_util()."'>modifier</a></td>";
            echo "<td><a href='désactiver_utilisateur.php?email_util=".$utilisateur->get_email_util()."'>Supprimer</td>";
            echo "</tr>";
        }
      }
    }
  } else if($choixutil === '3') { ?>
    <table>
    <tr><th>email</th><th>Nom</th><th>Prenom</th><th>Profil</th><th>Num licence</th><th>Sexe</th><th>Date de naissance</th><th>Adresse 1</th><th>Adresse 2</th>
    <th>Adresse 3</th><th>id club</th><th>Modifier</th><th>Supprimer</th></tr>
    <?php
      foreach ($adherents as $adherent) {
        if($adherent->get_statut_util() == 0){
          echo "<tr>";
          echo "<td>".$adherent->get_email_util()."</td>";
          echo "<td>".$adherent->get_nom_util()."</td>";
          echo "<td>".$adherent->get_prenom_util()."</td>";
          echo "<td>".$adherent->get_id_type_util()."</td>";
          echo "<td>".$adherent->get_lic_adh()."</td>";
          echo "<td>".$adherent->get_sexe_adh()."</td>";
          echo "<td>".$adherent->get_date_naissance_adh()."</td>";
          echo "<td>".$adherent->get_adr1_adh()."</td>";
          echo "<td>".$adherent->get_adr2_adh()."</td>";
          echo "<td>".$adherent->get_adr3_adh()."</td>";
          echo "<td>".$adherent->get_id_club()."</td>";
          echo "<td><a href='modification_adherent?email=".$adherent->get_email_util()."'>modifier</a></td>";
          echo "<td><a href='désactiver_adherent.php?email_util=".$adherent->get_email_util()."'>Supprimer</td>";
          echo "</tr>";
          }
      }
    } else { ?>
    <table>
    <tr><th>email</th><th>Nom</th><th>Prenom</th><th>Profil</th><th>Num licence</th><th>Matricule</th><th>Sexe</th><th>Date de naissance</th><th>Adresse 1</th><th>Adresse 2</th>
    <th>Adresse 3</th><th>id club</th></tr>
    <?php
      foreach ($adherents as $adherent) {
        if($adherent->get_statut_util() == 0){
          echo "<tr>";
          echo "<td>".$adherent->get_email_util()."</td>";
          echo "<td>".$adherent->get_nom_util()."</td>";
          echo "<td>".$adherent->get_prenom_util()."</td>";
          echo "<td>".$adherent->get_id_type_util()."</td>";
          echo "<td>".$adherent->get_lic_adh()."</td>";
          echo "<td></td>";
          echo "<td>".$adherent->get_sexe_adh()."</td>";
          echo "<td>".$adherent->get_date_naissance_adh()."</td>";
          echo "<td>".$adherent->get_adr1_adh()."</td>";
          echo "<td>".$adherent->get_adr2_adh()."</td>";
          echo "<td>".$adherent->get_adr3_adh()."</td>";
          echo "<td>".$adherent->get_id_club()."</td>";
          echo "</tr>";
          }
      }
      foreach ($utilisateurs as $utilisateur) {
        if($utilisateur->get_statut_util() == 0){
              echo "<tr>";
              echo "<td>".$utilisateur->get_email_util()."</td>";
              echo "<td>".$utilisateur->get_nom_util()."</td>";
              echo "<td>".$utilisateur->get_prenom_util()."</td>";
              echo "<td>".$utilisateur->get_id_type_util()."</td>";
              echo "<td></td>";
              echo "<td>".$utilisateur->get_matricule_cont()."</td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "</tr>";
          }
        }
      }
    }
else{ 
?>
//header('location: ../profil?mail='.$_SESSION['email_util'].''); 
<script>
window.location.replace("../profil?mail=<?php echo $_SESSION['email_util']; ?>");
</script>
<?php
}
?>
</table>
</center>
</body>
</html>