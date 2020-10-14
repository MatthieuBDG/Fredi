<?php
require_once('../DAO/utilisateur.php');
require_once('../init.php');
require_once('../DAO/PeriodeDAO.php');
session_start();

if(isset($_SESSION['id'])) {
    $statut_util = $_SESSION['statut_util'];
    //Verifie si il s'agit d'un admin
    if($statut_util->get_id_type_util() == 2 || $user->get_id_type_util() == 3) {
        header('Location: index.php');
    }

//Collection des periodes
$periodes = new PeriodeDAO();
$rows = $periodes->findAll();

//Permet de desactiver une periode
$annee = isset($_POST['annee']) ? $_POST['annee'] : '';
$submit = isset($_POST['desactiverPeriode']);

$error = '';

if($submit) {
    $periode = new PeriodeDAO();
    $error = $periode->desactiverPeriode($annee);
}
?>

<br><br><br><br><br>

<center>


<table>
<tr><th>anne_per</th><th>forfait_hm_per</th><th>statut_per</th><th>Modifier</th><th>Supprimer</th></tr>
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
}else{
  header('location: ../profil?annee_per='.$_SESSION['annee_per'].''); 
}
?>

</table>
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