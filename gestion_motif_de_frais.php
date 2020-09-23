<?php

$file = fopen("Design/motif_de_frais.csv", "r") or exit("<p>Impossible de lire le
fichier</p>"); //ouverture du fichier csv
$nb=0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/styles.css" type="text/css" />
  <title>motif de frais </title>
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
      }
      echo "</tr>";
    }
  echo "</table>";
  fclose($file);
    ?>
</body>
</html>