<?php   
require_once('../init.php');
include '../connexion_dbh.php';

if($_SESSION['id_type_util'] == 1) {
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
$dao = new Motif_fraisDAO();
$motif_frais = $dao->findAll();

//Permet de desactiver une motif_frais
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);


if($submit) {
    $motif_frais = new Motif_fraisDAO();
    $error = $periode->desactiverPeriode($annee);
}
?>

<br><br><br><br><br>

<center>

<table>
<tr><th>id_mdf</th><th>lib_mdf</th><th>Modifier</th><th>Supprimer</th></tr>
<?php   

foreach ($motif_frais as $motif_frais) {
    echo "<tr>";
    echo "<td>".$motif_frais->get_id_mdf()."</td>";
    echo "<td>".$motif_frais->get_lib_mdf()."</td>";
    echo "<td><a href='modification_motif_de_frais?id_mdf=".$motif_frais->get_id_mdf()."'>modifier</a></td>";
    echo "<td><a href='désactiver_motif_de_frais?id_mdf=".$motif_frais->get_id_mdf()."'>Supprimer</td>";
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