<?php
include '../connexion_dbh.php';

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
  <<<<<<< HEAD
  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>gestion</title>
=======
  <link rel="stylesheet" href="css/styles.css" type="text/css" />
  <title>Gestion</title>
>>>>>>> 0a32bb76e72d19b1ce09ebc2b56ca63d5b498f36
</head>

<body>
  <table>
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