<?php
include 'connexion_dbh.php';
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
<li><a class="active" href="index">Accueil</a></li>
<?php if(!isset($_SESSION['email_util'])) { ?>
<li><a  href="connexion">Connexion</a></li>
<?php }else{ ?>
<li><a href="deconnexion">Deconnexion</a></li>
<?php } ?>
<li><a href="#contact">Contact</a></li>
<li><a  href="#about">About</a></li>
<?php if(isset($_SESSION['email_util'])) { ?>
<li><a href="profil?mail=<?php echo $_SESSION['email_util'] ?>"><?php echo $_SESSION['prenom_util']; ?></a></li>
<?php } ?>
</ul>     
</div>   
</header>
<body class="index">
<div class="connexion">
<p>Bienvenue <?php if(isset($_SESSION['email_util'])) { echo $_SESSION['prenom_util']; } ?> sur Fredi</p>
</div>
</body>
</html>