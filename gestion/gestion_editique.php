<?php   
require_once('../init.php');
include '../connexion_dbh.php';

if($_SESSION['id_type_util'] == 3) {
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
//Collection des motif_frais
$dao = new Ligne_de_fraisDAO();
$ligne_de_frais = $dao->findAll();

//Permet de desactiver une motif_frais
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);

?>

<br><br><br><br><br>

<center>
<p><a class='lien' href="../ajouter_ligne_de_frais">Ajout de ligne de frais</a></p>
<br>
<table>
<tr><th>id_ldf</th><th>date_ldf</th><th>lib_trajet_ldf</th><th>cout_peage_ldf</th><th>cout_repas_ldf</th>
<th>cout_hebergement_ldf</th><th>nb_km_ldf</th><th>total_km_ldf</th><th>total_ldf</th>
<th>id_mdf</th><th>annee_per</th><th>email_util</th><th>Modifier</th><th>Supprimer</th></tr>

         <p>Choississez la période</p>
         <select name="emailutilisateur">
         <?php
            foreach ($utilisateur as $utilisateur) {
                if ($utilisateur->get_matricule_cont() != 0){
                    echo '<option value='.$utilisateur->get_email_util().'>'.$utilisateur->get_email_util().'</option>';
                }
            }
         
}else{
    header('location: ../profil?mail='.$_SESSION['email_util'].'');  
}
?>


</center>
</body>
</html>