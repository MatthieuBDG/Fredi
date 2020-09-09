<?php

session_start();

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

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $dbh->prepare('SELECT ID_Members,Pseudo FROM Members WHERE Mail = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $pseudo = $mailexist->fetch();
            $pseudo = $pseudo['Pseudo'];
            
         $_SESSION['recup_mail'] = $recup_mail;
         $recup_code="";
         for ($a=0; $a<8; $a++) {
            $recup_code .= mt_rand(0,9);
         }
         
            $mail_recup_exist = $dbh->prepare('SELECT ID_Members FROM Recuperation WHERE Mail = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            if($mail_recup_exist == 1) {
               $recup_insert = $dbh->prepare('UPDATE Recuperation SET Code = ? WHERE Mail = ?');
               $recup_insert->execute(array($recup_code,$recup_mail));
            } else {
               $recup_insert = $dbh->prepare('INSERT INTO Recuperation(Mail,Code) VALUES (?, ?)');
               $recup_insert->execute(array($recup_mail,$recup_code));
            }
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

        <p style="text-align: center;">Salut '.$pseudo.',</p>
        <p><b>'.$recup_code.'</b></p>

        </body>
         </html>
         ';
         mail($recup_mail, "Récupération de mot de passe - Fredi", $message, $header);
         header("Location:recuperation?section=code");
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
if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $dbh->prepare('SELECT ID_Members FROM Recuperation WHERE Mail = ? AND Code = ?');
      $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
      $verif_req = $verif_req->rowCount();
      if($verif_req == 1) {
         $up_req = $dbh->prepare('UPDATE Recuperation SET Confirme = 1 WHERE Mail = ?');
         $up_req->execute(array($_SESSION['recup_mail']));
         header('Location:../recuperation?section=changemdp');
      } else {
         $erreur = "<h3>Code invalide</h3>";
      }
   } else {
      $erreur = "<h3>Veuillez entrer votre code de confirmation</h3>";
   }
}
if(isset($_POST['change_submit'])) {
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
      $verif_confirme = $dbh->prepare('SELECT Confirme FROM Recuperation WHERE Mail = ?');
      $verif_confirme->execute(array($_SESSION['recup_mail']));
      $verif_confirme = $verif_confirme->fetch();
      $verif_confirme = $verif_confirme['Confirme'];
      if($verif_confirme == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);
         $mdplength = strlen($mdp);
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
               if($mdplength >= 8) {
               $mdp = password_hash($mdp,PASSWORD_DEFAULT);
               $ins_mdp = $dbh->prepare('UPDATE Members SET Mdp = ? WHERE Mail = ?'); 
               $ins_mdp->execute(array($mdp,$_SESSION['recup_mail'])); 
               $del_req = $dbh->prepare('DELETE FROM Recuperation WHERE Mail = ?'); 
               $del_req->execute(array($_SESSION['recup_mail']));
               $mdpmodifier="<h3>Le mot de passe à bien été modifié !</h3>";
            }else{
               $erreur="<h3>Le mot de passe doit faire au mois 8 caractères ( $mdplength caractère(s) )</h3>";
            }
            } else {
               $erreur = "<h3>Les mots de passes ne correspondent pas</h3>";
            }
         } else {
            $erreur = "<h3>Tous les champs doivent être complétés !</h3>";
         }
      } else {
         $erreur = "<h3>Veuillez valider votre adresse mail grâce au code de vérification qui vous a été envoyé par mail (si vous n'avez pas reçu de mail <a href='contact'>Contacter nous</a>)</h3>";
      }
   } else {
      $erreur = "<h3>Tous les champs doivent être complétés !</h3>";
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
if(!isset($_GET['section']) AND !isset($erreur)){
 echo "<br>";
}
if(isset($erreur)) { echo '<span style="color:red">'.$erreur.'</span>'; } else { echo ""; } 
if(isset($mdpmodifier))
{
   echo "<br>";
   echo '<font color="green">'.$mdpmodifier."</font>";
   echo "<br><br>";
   echo '<a href="connexion" id="bouton1">Se connecter</a>';
   exit;
}
?>

<?php if($section == 'code') { ?>
   <h3 style="color:green">Un code de vérification vous a été envoyé par mail !</h3>
<br/>
<form method="post">
   <input type="text" placeholder="Code de vérification" name="verif_code"/><br/>
   <input type="submit" value="Valider" name="verif_submit"/>
</form>
<?php } elseif($section == "changemdp") { ?>
   <h3 style="color:black">Nouveau mot de passe :</h3>
<form method="post">
   <input type="password" placeholder="Nouveau mot de passe" name="change_mdp"/><br/>
   <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc"/><br/>
   <input type="submit" value="Valider" name="change_submit"/>
</form>
<?php } else { ?>
<form method="post">
   <input type="email" placeholder="Votre adresse mail" name="recup_mail"/><br/>
   <input type="submit" value="Valider" name="recup_submit"/>
</form>
<?php } ?>

</div>    
</center>
    
</body>
</html>
      



