<?php
include 'connexion_dbh.php';

if(isset($_GET['mail'])){
$mail = $_GET['mail'];
$req_user = $dbh->prepare("SELECT * FROM utilisateur WHERE email_util = ?");
$req_user->execute(array($mail));
$resultat = $req_user->fetch();

}else{
header("location: index");   
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>
<header>
<div class="menu">
<ul>
<li><a href="index">Accueil</a></li>
<?php if(!isset($_SESSION['email_util'])) { ?>
<li><a  href="connexion">Connexion</a></li>
<?php }else{ ?>
<li><a href="deconnexion">Deconnexion</a></li>
<?php } ?>
<li><a href="#contact">Contact</a></li>
<li><a  href="#about">About</a></li>
<?php if(isset($_SESSION['email_util'])) { ?>
<li><a class="active" href="profil?mail=<?php echo $_SESSION['email_util'] ?>"><?php echo $_SESSION['prenom_util']; ?></a></li>
<?php } ?>
</ul>     
</div>   
</header>
<body class="profil">
<div class="profil">
<div class="container">
<center>
<img class="avatar" src="images/avatar-icon.png" alt="avatar-icon" >
<?php if($resultat['id_type_util'] == 1){ ?>
<h3><?php echo $resultat['prenom_util'] ?> vous etes admin.</h3>
<?php }elseif($resultat['id_type_util'] == 2){ ?>
<h3><?php echo $resultat['prenom_util'] ?> vous êtes controleur.</h3>
<?php }else{ ?>
<h3><?php echo $resultat['prenom_util'] ?> vous etes adherent.</h3>
<?php } ?>
<hr>
<?php if($resultat['id_type_util'] == 1){ ?>
<div class="div-lien">
<p><a class='lien' href="gestion/gestion_utilisateur">Gestion utilisateur</a></p>
<p><a class='lien' href="gestion/gestion_motif_de_frais">Gestion motif de frais</a></p>
<p><a class='lien' href="gestion/gestion_période">Gestion période</a> </p>  
</div>



</ul>
<?php }elseif($resultat['id_type_util'] == 2){ ?>
<div class="div-lien">
<p><a class='lien' href="gestion/gestion_ligue">Gérer des ligues</a></p>
<p><a class='lien' href="gestion/gestion_club">Gérer des clubs</a></p>
<p><a class='lien' href="gestion/gestion_">Editique</a> </p>  
</div>
<?php }else{ ?>
<div class="div-lien">
<p><a class='lien' href="gestion/gestion_ligne_de_frais">Gérer les lignes de frais</a></p>
</div>
<?php } ?>

</center>
</div>
</div>
</body>
</html>