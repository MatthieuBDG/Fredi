
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
?>
<br><br><br><br><br>

<center>
<select name="util" id="util-select">
  <option value="">--Choissisez un type d'utilisateur--</option>
  <option value="adhérent">Adhérent</option>
  <option value="administrateur">Administrateur</option>
  <option value="controleur">Controleur</option>  
</select>

<table>
<tr><th>email</th><th>Nom</th><th>Prenom</th><th>id util</th><th>Modifier</th><th>Supprimer</th></tr>

<?php 
foreach ($utilisateurs as $utilisateur) {
  if($utilisateur->get_statut_util() == 0){
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
}else{
  header('location: ../profil?mail='.$_SESSION['email_util'].''); 
}
?>
</table>
</center>
</body>
</html>