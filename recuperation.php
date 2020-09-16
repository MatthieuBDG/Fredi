<?php

include 'connexion_dbh.php';

if(isset($_SESSION['email_util'])) {
$_SESSION = array();
session_destroy();
 
}


if(isset($_POST['recup_submit'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $dbh->prepare('SELECT email_util,password_util FROM utilisateur WHERE email_util = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $mail = $mailexist->fetch();
            $mdp = $mail['password_util'];


         $section = "<h5>Votre mot de passe vient de vous etre renvoyé à l'adresse mail suivante : $recup_mail</h5>";

         } else {
            $erreur = "<h5>Cette adresse mail n'est pas enregistrée</h5>";
         }
      } else {
         $erreur = "<h5>Adresse mail invalide</h5>";
      }
   } else {
      $erreur = "<h5>Veuillez entrer votre adresse mail</h5>";
   }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperation</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>
<div class="menu">
<ul>
<li><a href="index">Accueil</a></li>
<?php if(!isset($_SESSION['email_util'])) { ?>
<li><a href="connexion">Connexion</a></li>
<?php }else{ ?>
<li><a href="deconnexion">Deconnexion</a></li>
<?php } ?>
<li><a href="#contact">Contact</a></li>
<li><a  href="#about">About</a></li>
<?php if(isset($_SESSION['email_util'])) { ?>
<li><a href=""><?php echo $_SESSION['prenom_util']; ?></a></li>
<?php } ?>
</ul>     
</div>
<body class="recuperation">
<center>

<div class="recuperation">
<h1>Recupération de mot de passe</h1>


<br/>
<form method="post">
   <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
<?php
if(isset($erreur)) { echo '<span style="color:red">'.$erreur.'</span>'; }else { echo ""; } 

if(isset($section)) { echo '<span style="color:green">'.$section.'</span>'; }else { echo ""; }

?>
   <input type="submit" value="Valider" name="recup_submit"/>

</form>


</div>    
</center>
    
</body>
</html>
      



