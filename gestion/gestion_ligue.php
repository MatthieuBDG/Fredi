<?php
include '../connexion_dbh.php';
include '../init.php';

if($_SESSION['id_type_util'] == 2){
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>Gérer des ligues</title>
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
$dao = new ligueDAO();
$ligues = $dao->findAll(); 
?>

<br><br><br><br><br>
 <center>
 <p><a class='lien' href="../ajouter_ligue">Ajout de ligue</a></p>
  <table>
  <tr><th>id ligue</th><th>lib ligue</th><th>url ligue</th><th>telephone ligue</th><th>contact util</th><th>email ligue</th><th>Modifier</th><th>Supprimer</th></tr>
  <?php
    foreach ($ligues as $ligue) {
          echo "<tr>";
          echo "<td>".$ligue->get_id_ligue()."</td>";
          echo "<td>".$ligue->get_lib_ligue()."</td>";
          echo "<td>".$ligue->get_url_ligue()."</td>";
          echo "<td>".$ligue->get_contact_ligue()."</td>";
          echo "<td>".$ligue->get_telephone_ligue()."</td>";
          echo "<td>".$ligue->get_email_util()."</td>";
          echo "<td><a href='modification_ligue?id_ligue=".$ligue->get_id_ligue()."'>modifier</a></td>";
          echo "<td><a href='désactiver_ligue.php?email_util=".$ligue->get_email_util()."'>Supprimer</td>";
          echo "</tr>";
    }
}
else{
  header('location: ../profil?mail='.$_SESSION['email_util'].''); 
}
?>
</table>
</center>
</body>
</html>