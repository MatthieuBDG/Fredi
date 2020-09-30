<?php
include '../connexion_dbh.php';
include '../init.php';

if(isset($_SESSION['id_type_util']) == 1){

$file = fopen("../Design/licencies.csv", "r") or exit("<p>Impossible de lire le
fichier</p>"); //ouverture du fichier csv
$nb=0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>gestion</title>

  

</head>

<body>

<?php
$dao = new adherentDAO();
$adherents = $dao->findAll(); 
?>

<table> 
<tr><th>email</th><th>Num licence</th><th>sexe</th><th>date de naissance</th>
<th>adresse1</th><th>id_club</th></tr>
<?php
foreach ($adherents as $adherent) {
    echo "<tr>";
    echo "<td>".$adherent->get_email_util()."</td>";
    echo "<td>".$adherent->get_lic_adh()."</td>";
    echo "<td>".$adherent->get_sexe_adh()."</td>";
    echo "<td>".$adherent->get_date_naissance_adh()."</td>";
    echo "<td>".$adherent->get_adr1_adh()."</td>";
    echo "<td>".$adherent->get_id_club()."</td>";
    echo "</tr>";
}
?>
</table>
<?php
    while (!feof($file)) {
      echo "<tr>";
      $row=fgetcsv($file, 0, ';');
      $nb++;
      echo "<tr>";
      if(is_array($row)){
        foreach ($row as $value) {
          echo "<td>".$value."</td>";
        }
        echo "<td>Modifier</td>";
        echo "<td>Désactiver</td>";
      }
      echo "</tr>";
    }
  echo "</table>";
  fclose($file);
  foreach ($row as $value) {
    
  }
    ?>
</body>
</html>
<?php }else{
  header("location: ../connexion");   
  }
?>