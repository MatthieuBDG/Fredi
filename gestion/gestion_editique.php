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
  <title>Gestion éditique</title>
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
//Collection des périodes
$dao = new PeriodeDAO();
$periodes = $dao->findAll();

//Collection des adhérents
$dao1 = new adherentDAO();
$adherents = $dao1->findAll();

?>

<br><br><br><br><br>

<center>
<br>

         <p>Choississez la période</p>
         <select name="periode">
         <?php
            foreach ($periodes as $periode) {
                    echo '<option value='.$periode->get_annee_per().'>'.$periode->get_annee_per().'</option>';
            }
            ?>

            <br><br><br><br><br><br>
            </select>
        <p>Choississez l'adhérent</p>
         <select name="adherent">
         <?php
            foreach ($adherents as $adherent) {
                    echo '<option value='.$adherent->get_email_util().'>'.$adherent->get_email_util().'</option>';
            }
            ?>
        </select>
    <?php     
}else{
    header('location: ../profil?mail='.$_SESSION['email_util'].'');  
}
?>


</center>
</body>
</html>