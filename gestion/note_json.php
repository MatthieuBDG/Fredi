<?php
include '../connexion_dbh.php';
include '../init.php';

if($_SESSION['id_type_util'] == 1){

 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/styles.css" type="text/css" />
  <title>note json </title>

</head>

<body>
  <h1>JSON</h1>
  <?php

/*L’utilisateur appelle une URL en fournissant son email et son mot de passe et en retour, 
le webservice renvoie :*/




//tableau d'utilisateur 
$info_utilisateur = "SELECT email_util,nom_util, prenom_util,statut_util ,  id_type_util FROM utilisateur where email_util   ";
$tab_utilisateur= array(
  "email" => $info_utilisateur[0],
  "nom" => $info_utilisateur[1],
  "prenom" => $info_utilisateur[2],
  "type" => $info_utilisateur[3],
 );


// tableau de periode 

$info_periode = "SELECT annee_per,forfait_km_per,statut_per from periode where statut_per " ;
$tab_periode= array( 
  "date" => $info_periode[0],
  "forfait" => $info_periode[1],
  "statut" => $info_periode[2]

);
//tableau ligne 
$info_lignes = "SELECT id_ldf ,date_ldf ,lib_trajet_ldf ,cout_peage_ldf , cout_repas_ldf , cout_hebergement_ldf , nb_km_ldf , 	Stotal_km_ldf , 	total_ldf FROM ligne_de_frai WHERE " ; 
$tableau_lignes= array();
foreach ($tab_lignes as $lignes){
$lignes_array = array (
  "id "=> $lignes[0],
"date"=> $lignes[1],
"libelle"=> $lignes[2],
"cout_peage"=> $lignes[3],
"cout_repas"=> $lignes[4],
"cout_hebergement"=> $lignes[5],
"nb_km"=> $lignes[6],
"cout_km"=> $lignes[7],
"total_ligne"=> $lignes[8],
"motif"=> $lignes[9],

);
$tableau_lignes [] = $lignes_array();
}
echo "<pre>";
print_r($periode);
echo "</pre>";

?>
<p><a href="?????.php">Page 2 : envoi du fichier JSON au navigateur</a></p>
</body>
</html>