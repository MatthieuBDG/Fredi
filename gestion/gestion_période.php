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
  <title>Gestion utilisateurs</title>
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
//Collection des periodes
$dao = new PeriodeDAO();
$periodes = $dao->findAll();

//Permet de desactiver une periode
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);


if($submit) {
    $periode = new PeriodeDAO();
    $error = $periode->desactiverPeriode($annee);
}
?>

<br><br><br><br><br>

<center>

<table>
<tr><th>annee_per</th><th>forfait_hm_per</th><th>statut_per</th><th>Modifier</th><th>Supprimer</th></tr>
<?php   

foreach ($periodes as $periode) {
    if($periode->get_statut_per() == 0){
    echo "<tr>";
    echo "<td>".$periode->get_annee_per()."</td>";
    echo "<td>".$periode->get_Tarif()."</td>";
    echo "<td>".$periode->get_statut_per()."</td>";
    echo "<td><a href='modification_periode?annee_per=".$periode->get_annee_per()."'>modifier</a></td>";
    echo "<td><a href='désactiver_periode.php?annee_per=".$periode->get_annee_per()."'>Supprimer</td>";
    echo "</tr>";
  }
}
?>
</table>
<?php
}else{
    header('location: ../profil?mail='.$_SESSION['email_util'].'');  
}
?>


</center>
<script>
    function supprimerLigne() {
        if(confirm("Vouslez-vous supprimer la ligne de frais ?")) {
            window.location.href = "display_notes.php?supprimer=<?php echo $row->get_id_ligne(); ?>";
        }
    }
    </script>
</body>
</html>