<?php

include 'connexion_dbh.php';
include 'init.php';

$dao = new utilisateurDAO();
$utilisateur = $dao->findAll(); 

if(isset($_SESSION['id_type_util']) == 2){
if(isset($_POST["submit"])){ // Debut de la inscription

  $lib_ligue = htmlspecialchars($_POST["lib_ligue"]);
  $url_ligue = htmlspecialchars($_POST["url_ligue"]);
  $contact_ligue = htmlspecialchars($_POST['contact_ligue']);
  $telephone_ligue = htmlspecialchars($_POST['telephone_ligue']);
  $email_util = htmlspecialchars($_POST['email_util']);

        if(!empty($lib_ligue) AND !empty($url_ligue) AND !empty($contact_ligue) AND !empty($telephone_ligue) AND !empty($email_util)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur
        
        $req_verif_lib_ligue_inscription = $dbh->prepare("SELECT lib_ligue FROM ligue WHERE lib_ligue = ?");
        $req_verif_lib_ligue_inscription->execute(array($lib_ligue));
        $resultat_lib_ligue = $req_verif_lib_ligue_inscription->rowCount();

        if($resultat_lib_ligue == 0){
        $req_ajout_ligue = $dbh->prepare("INSERT INTO ligue (id_ligue,lib_ligue,url_ligue,contact_ligue,telephone_ligue,email_util) VALUES (?,?,?,?,?,?)");
        $req_ajout_ligue->execute(array($id_ligue,$lib_ligue,$url_ligue,$contact_ligue,$telephone_ligue,$email_util)); 

        $inscription = "<h5>La ligue $lib_ligue a été créé dans l’application FREDI</h5>";
        
        }else{
            $erreur = "<h5> Vous ne pouvez pas créer la ligue $lib_ligue car une ligue active existe déjà </h5>"; //message erreur
        }
        }else{
            $erreur = "<h5>Vous ne pouvez pas créer la ligue ".$lib_ligue." car une information n'a pas été saisie</h5>"; //message erreur
        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'une ligue</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>
<header>
<div class="menu">
<ul>
<li><a  href="index">Accueil</a></li>
<?php if(!isset($_SESSION['email_util'])) { ?>
<li><a class="active" href="connexion">Connexion</a></li>
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
<body class="connexion">
<div class="connexion">
    <center>
      <h1>Ajout d'une ligue</h1>
        <br>
         <form method="post">
         <p>lib ligue <br><input type="text" name="lib_ligue" placeholder="Lib ligue" value="<?php if(!empty($lib_ligue)){ echo $lib_ligue; } ?>"require/></p>
         <p>url ligue <br><input type="text" name="url_ligue" placeholder="url_ligue" value="<?php if(!empty($url_ligue)){ echo $url_ligue; } ?>"require/></p>
         <p>contact ligue <br><input type="text" name="contact_ligue" placeholder="contact_ligue" value="<?php if(!empty($contact_ligue)){ echo $contact_ligue; } ?>"require/></p>
         <p>téléphone ligue <br><input type="text" name="telephone_ligue" placeholder="telephone_ligue" value="<?php if(!empty($telephone_ligue)){ echo $telephone_ligue; } ?>"require/></p>
         

         <form>
         <select name="emailutilisateur">

         <?php
            foreach ($utilisateur as $utilisateur) {
                if ($utilisateur->get_matricule_cont() != 0){
                    echo '<option value='.$utilisateur->get_email_util().'>'.$utilisateur->get_email_util().'</option>';
                }
            }
         ?>

         </select>
         </form>
        
         <p>email ligue<br>
         <input type="email" name="email_util" placeholder="email_util" value="<?php if(!empty($email_util)){ echo $email_util; } ?>"require/>
         </p>
         <br>
      
         <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         if(isset($inscription))
         {
            echo '<font color="green">'.$inscription."</font>";
            exit;
         }
        ?>
        <input type="submit" name="submit" value="Ajouter" />
        </form>
    </center>  
</div>   
<?php 
}else{
header("location: connexion?erreur=1");
} ?> 
</body>
</html>
