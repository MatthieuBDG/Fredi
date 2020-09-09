<?php

include 'connexion_dbh.php';

if(isset($_SESSION['ID_Members'])) {
setcookie('email','',time()-3600);
setcookie('password','',time()-3600);
$_SESSION = array();
session_destroy();
 
}

if(isset($_GET['section'])) {
   $section = htmlspecialchars($_GET['section']);
} else {
   $section = "";
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

        $header="MIME-Version: 1.0\r\n";
         $header.='From:"fredi.com"<support@fredi.com>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '
         <html>
         <head>
           <title>Récupération de mot de passe - Fredi</title>
           <meta charset="utf-8" />
         </head>
        <body>

        <p style="text-align: center;">Salut '.$recup_mail.',</p>
        <p><b>'.$mdp.'</b></p>

        </body>
         </html>
         ';
         mail($recup_mail, "Récupération de mot de passe - Fredi", $message, $header);
         header("Location:recuperation?section=envoyer");
         } else {
            $erreur = "<h3>Cette adresse mail n'est pas enregistrée</h3>";
         }
      } else {
         $erreur = "<h3>Adresse mail invalide</h3>";
      }
   } else {
      $erreur = "<h3>Veuillez entrer votre adresse mail</h3>";
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
<body>
<center>
<br>
<a href="index" id="bouton">accueil</a>
<div class="recuperation">
<h1>Recupération de mot de passe</h1>

<?php
if(isset($erreur)) { echo '<span style="color:red">'.$erreur.'</span>'; } else { echo ""; } 
?>
<?php if($section == 'envoyer') { ?>
   <h3 style="color:green">Un code de vérification vous a été envoyé par mail !</h3>
<br/>
<?php } ?>
<form method="post">
   <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
   <input type="submit" value="Valider" name="recup_submit"/>
</form>


</div>    
</center>
    
</body>
</html>
      



