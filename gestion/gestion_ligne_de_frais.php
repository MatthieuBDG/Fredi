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
  <title>Gestion ligne de frais</title>
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

//Collection des periodes
$dao1 = new PeriodeDAO();
$periodes = $dao1->findAll();
$valeur = $dao1->test();

//Permet de desactiver une motif_frais
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);

?>

<br><br><br><br><br>

<center>
<p><a class='lien' href="../ajouter_ligne_de_frais">Ajout de ligne de frais</a></p>
<br>

<?php

foreach ($periodes as $periode) {
    if ($periode->get_statut_per()==1){
        echo "<tr>";
        echo "<td>La période active est : ".$periode->get_annee_per()."</td>";
        echo "</tr>";
        echo "<p></p>";
    }    
}

if($valeur==0){
     echo "<p>La note de frais ne peut être imprimée : aucun frais n’a été créé pour cette période.</p>";
} 
?>

<table>
<tr><th>id_ldf</th><th>date_ldf</th><th>lib_trajet_ldf</th><th>cout_peage_ldf</th><th>cout_repas_ldf</th>
<th>cout_hebergement_ldf</th><th>nb_km_ldf</th><th>total_km_ldf</th><th>total_ldf</th>
<th>id_mdf</th><th>annee_per</th><th>email_util</th><th>Modifier</th><th>Note de frais</th><th>Cerfa</th><th>Cumul de frais</th><th>Supprimer</th></tr>
<?php   

foreach ($ligne_de_frais as $ligne_de_frais) {
    echo "<tr>";
    echo "<td>".$ligne_de_frais->get_id_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_date_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_lib_trajet_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_cout_peage_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_cout_repas_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_cout_hebergement_ldf()."</td>";    
    echo "<td>".$ligne_de_frais->get_nb_km_ldf()."</td>";   
    echo "<td>".$ligne_de_frais->get_total_km_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_total_ldf()."</td>";
    echo "<td>".$ligne_de_frais->get_id_mdf()."</td>";
    echo "<td>".$ligne_de_frais->get_annee_per()."</td>";
    echo "<td>".$ligne_de_frais->get_email_util()."</td>";
    $req_verif_annee_per_note_de_frais = $dbh->prepare("SELECT * FROM periode WHERE annee_per = ? AND statut_per = ?");
    $req_verif_annee_per_note_de_frais->execute(array($ligne_de_frais->get_annee_per(),1));
    $resultat_annee_per = $req_verif_annee_per_note_de_frais->rowCount();
    echo "<td><a href='modification_ligne_de_frais?id_ldf=".$ligne_de_frais->get_id_ldf()."'>modifier</a></td>";
    if($resultat_annee_per == 1){
    echo "<td><a href='note_de_frais_pdf?email=".$ligne_de_frais->get_email_util()."&id_mdf=".$ligne_de_frais->get_id_mdf()."'>Imprimer</td>";
    }else{
    echo "<td>Impression impossible</td>";    
    }
    echo "<td><a href='cerfa_pdf?email=".$ligne_de_frais->get_email_util()."&id_mdf=".$ligne_de_frais->get_id_mdf()."'>Imprimer</td>";
    echo "<td><a href='cumul_de_frais_pdf?id=".$ligne_de_frais->get_id_mdf()."&per=".$ligne_de_frais->get_annee_per()."'>Imprimer</td>";
    echo "<td><a href='désactiver_ligne_de_frais?id_ldf=".$ligne_de_frais->get_id_ldf()."'>Supprimer</td>";
    
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