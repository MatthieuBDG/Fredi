
<?php
include '../connexion_dbh.php';
include '../init.php';
if(isset($_SESSION['id_type_util']) == 1){
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

<?php
$dao = new utilisateurDAO();
$utilisateurs = $dao->findAll(); 
?>
<center>
<table>
<tr><th>email</th><th>Nom</th><th>Prenom</th><th>id util</th><th>Modifier</th><th>Supprimer</th></tr>
<?php
foreach ($utilisateurs as $utilisateur) {
    echo "<tr>";
    echo "<td>".$utilisateur->get_email_util()."</td>";
    echo "<td>".$utilisateur->get_nom_util()."</td>";
    echo "<td>".$utilisateur->get_prenom_util()."</td>";
    echo "<td>".$utilisateur->get_id_type_util()."</td>";
    echo "<td><a href='modification_utilisateur?email=".$utilisateur->get_email_util()."'>modifier</a></td>";
    echo '<td><a href="gestion_utilisateur.php?email_util='.$utilisateur['email_util'].'"></td>';
    echo "</tr>";
}
}
?>
</table>
</center>
</body>
</html>