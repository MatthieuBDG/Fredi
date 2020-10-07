

Aller au contenu
Utiliser Messagerie Institut Limayrac avec un lecteur d'écran
Meet
Nouvelle réunion
Mes réunionsNouveau
Hangouts

Conversations
0,52 Go utilisés
Gérer
Règlement du programme
Fourni par Google
Dernière activité sur le compte : il y a 1 minute
Détails

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/compte.css">
</head>
<body>
<?php include 'top.php';?>
<?php include 'menu.php'; ?> 

<br>
<div class="outer-div">
        <div class="inner-div">
<?php if(isset($_SESSION['session_username'])) {
  echo '<h2>'.$_SESSION['session_libtype'].'</h2>'; 
  }else {
    echo'<center><h3 style="color:red"> Il semblerai qu&apos;il y ai une erreur, veuillez r&eacute;essayer.</h3></center>';
  }?>
  
<br><br><br>

<hr color="black">
<nav>
  <ul>
      <li><a href="ajouter.php">Ajouter</a></li>
      <li><a href="modifier.php">Modifier</a></li>
      <li><a href="desactiver.php">Desactiver</a></li>
      <li><a href="supprimer.php">Supprimer</a></li>
      <li><a href="javascript:history.go(-1)">Retour</a></li>
  </ul>
</nav>
<hr color="black">  
<?php

$order ='';
  $tri = isset($_GET['tri']) ? $_GET['tri']: 0; // recupere le tri, envoyé avec les icones du tableau
  switch ($tri){ // switch, completera le order by de la requete sql
    case 0:
      $order = "email_util";
    break;
    case 1:
      $order = "password_util";
    break;
    case 2:
      $order = "nom_util";
    break;
    case 3:
      $order = "prenom_util";
    break;
    case 4:
      $order = "statut_util";
    break;
    case 5:
      $order = "matricule_cont";
    break;
    case 6:
      $order = "id_type_util";
    break;
    default:
    break;
  }

  //pour filtrer les questions sans réponse
  if (isset($_POST['vide'])){ // si $post[vide] existe
    $is_vide = $_POST['vide'];
  }
  else {
      $is_vide =0; // sinon booléen à 0
  } 
  if ($is_vide==1){ // regarde le booleen est vrai
    $filtre_vide="AND reponse IS NULL"; //rajoute la condition en sql si vrai
  }
  else {$filtre_vide="";} //sinon ne rajoute rien dans la requete
  
  //pour filtrer par utilisateur
  if (isset($_POST['utilisateur'])){ // si $post[utilisateur] existe
    if ($_POST['utilisateur'] != '0') { // si ce n'est pas tous les utilisateurs
        $utilisateur = " AND pseudo='".$_POST['utilisateur']."'"; // complete la requete pour filtrer avec son nom
    }
    else {
      $utilisateur=""; // sinon requete inchangée
  }
  }
  else {
      $utilisateur=""; // sinon requete inchangée
  }

  $sql = "select email_util, password_util, nom_util, prenom_util,statut_util,matricule_cont,id_type_util from utilisateur WHERE is_disabled = '0'"; // requete sql
  $dsn = 'mysql:host=localhost;dbname=fredi;charset=UTF8'; 
  $user = 'root';
  $password = '';
  try {
  $dbh = new PDO($dsn, $user, $password);
  $sth = $dbh->prepare($sql);
  $sth->execute(); 
  $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $ex) {
  die("Erreur lors de la requête SQL : ".$ex->getMessage());
  }


  $modif = isset($_GET['modif']) ? $_GET['modif']: 0;  //Reception  numero erreur
switch ($modif) { //si pas de session -> echo erreur
  case 1 :
  echo"<p class='centre'>1 enregistrement ajouté.</p>";
  break;
  case 2:
  echo"<p class='centre'>1 enregistrement modifié.</p>"; 
  break;
  case 3:
  echo"<p class='centre'>1 enregistrement supprimé.</p>"; 
  break;
  default:
  break;
 }


  // Affichage de la liste des colonnes
  echo "<table>";  //liens qui envoie le mode de tri pour chaque th
  echo "<tr><th>E-mail</th>";
  echo "<th>Mot de passe</th>";
  echo "<th>Nom</th>";
  echo "<th>Prenom</th>";
  echo "<th>Statut</th>";
  echo "<th>Matricule</th>";
  echo "<th>Type utilisateur</th>";
  echo "</tr>";
  foreach ($rows as $row) //affichage en tableau
{ 
  echo "<tr>"; 
  echo "<td>".$row['email_util']."</td>"; 
  echo "<td><p>Confidentiel</p></td>"; 
  echo "<td>".$row['nom_util']."</td>"; 
  echo "<td>".$row['prenom_util']."</td>"; 
  echo "<td>".$row['statut_util']."</td>"; 
  echo "<td>".$row['matricule_cont']."</td>"; 
  echo "<td>".$row['id_type_util']."</td>"; 
  }
  echo "</tr>"; 
echo "</table>";
?><!--From pour modifier l'utilisateur en question -->
<br>
 <form action="modifier.php" method="post">
  <label for="email">E-Mail :</label><br>
  <input type="email" id="email" name="email" required><br><br>
  <label for="nom">Nom :</label><br>
  <input type="text" id="nom" name="nom" required><br><br>
  <label for="prenom">Prenom :</label><br>
  <input type="text" id="prenom" name="prenom" required><br><br>
  <label for="statut">Statut :</label><br>
  <input type="text" id="statut" name="statut" ><br><br>
  <label for="matricule">Matricule</label><br>
  <input type="text" id="matricule" name="matricule"><br><br>

<select name="typeutil" id="typeutil" required>
     <option value="1">Adhérent</option>
     <option value="2">Contrôleur</option>
     <option value="3">Administrateur</option>
</select>
  <input type="submit" name='enregistrement' value=" &nbsp;Envoyer ">
<?php
     
    $dbh = new PDO('mysql:host=localhost;dbname=fredi', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        if(isset($_POST['enregistrement'])){
          $email = $_POST['email'];
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $matricule = $_POST['matricule'];
          $typeutil = $_POST['typeutil'];
          $Statut = $_POST['statut'];        
          $sql = "UPDATE utilisateur SET nom_util=:nom, prenom_util=:prenom, matricule_cont=:matricule,statut_util=:statut, id_type_util=:typeutil WHERE email_util=:email"; 
          try { 
            $sth = $dbh->prepare($sql);
            $sth->execute(array( 
              ':email' => $email, 
              ':nom' => $nom,
              ':prenom' => $prenom,
              ':matricule' => $matricule,
              ':typeutil' => $typeutil,
              ':statut' => $Statut,
              )); 
            }catch (PDOException $ex) { 
            die("Erreur lors de la requête SQL : ".$ex->getMessage()); 
            }            
        }
        if(isset($_POST['enregistrement'])){
          echo "<br>L’utilisateur ".$nom." a été modifié dans la FREDI";
          $delai=10; 
          $url='modifier.php';
          header("Refresh: $delai;url=$url");
        }

  ?>
</form>

</body>
</html>
modifier.php
Affichage de modifier.php en cours...