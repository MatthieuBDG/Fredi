<?php   
require_once('../init.php');
include '../connexion_dbh.php';

if($_SESSION['id_type_util'] == 2) {
$id_type_util = $_SESSION['id_type_util'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>Gestion motif de frais</title>
</head>

<body>
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
<?php
//Collection des motif_frais
$dao = new clubDAO();
$club = $dao->findAll();

//Permet de desactiver une motif_frais
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);

?>

<br><br><br><br><br>

<center>
<p><a class='lien' href="../ajouter_club">Ajout de club</a></p>
<br>
<table>
<tr><th>id_club</th><th>lib_club</th><th>adr1_club</th><th>adr2_club</th><th>adr3_club</th><th>id_ligue</th><th>Modifier</th><th>Supprimer</th></tr>
<?php   

foreach ($club as $club) {
    echo "<tr>";
    echo "<td>".$club->get_id_club()."</td>";
    echo "<td>".$club->get_lib_club()."</td>";
    echo "<td>".$club->get_adr1_club()."</td>";
    echo "<td>".$club->get_adr2_club()."</td>";
    echo "<td>".$club->get_adr3_club()."</td>";
    echo "<td>".$club->get_id_ligue()."</td>";
    echo "<td><a href='modification_club?id_club=".$club->get_id_club()."'>modifier</a></td>";
    echo "<td><a href='désactiver_club?id_club=".$club->get_id_club()."'>Supprimer</td>";
    echo "</tr>";
}

?>
</table>
<?php
}else{
    header('location: ../profil?mail='.$_SESSION['email_util'].'');  
}
?>


</center>
</body>
</html>