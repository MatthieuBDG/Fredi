<?php


include 'connexion_dbh.php';

if(isset($_SESSION['id_type_util']) == 1){
$req_recup_annee_existe = $dbh->prepare("SELECT statut_per FROM periode ");
$req_recup_annee_existe->execute(array());
$resultat_annee = $req_recup_annee_existe->rowCount();
if($resultat_annee == 0){
if(isset($_POST["submit"])){ // Debut de la inscription

        $annee_per = htmlspecialchars($_POST["annee_per"]);
        $forfait_km_per = htmlspecialchars($_POST["forfait_km_per"]);

        $req_verif_annee_per_periode = $dbh->prepare("SELECT * FROM periode");
        $req_verif_annee_per_periode->execute(array());
        $resultat_annee_per = $req_verif_annee_per_periode->rowCount();
    
        if($resultat_annee_per['statut_per'] == 0){
        
        if(!empty($annee_per) AND !empty($forfait_km_per)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur
        
        $req_verif_annee_inscription = $dbh->prepare("SELECT * FROM periode WHERE annee_per = ?");
        $req_verif_annee_inscription->execute(array($annee_per));
        $resultat_annee = $req_verif_annee_inscription->rowCount();

        if($resultat_annee == 0){
        $req_ajout_periode = $dbh->prepare("INSERT INTO periode (annee_per,forfait_km_per,statut_per)VALUES (?,?,?)");
        $req_ajout_periode->execute(array($annee_per,$forfait_km_per,1)); 

        $inscription = "<h5>La période $annee_per a été créé dans la FREDI</h5>";
        
        }else{
            $erreur = "<h5> Vous ne pouvez pas créer la période $annee_per car une
            période active existe déjà </h5>"; //message erreur
        }
        }else{
            $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>"; //message erreur
        }
    }else{
        echo salut;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de période</title>
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
      <h1>Ajout de période</h1>
        <br>
         <form method="post">
         <p>Annee <br><input type="text" name="annee_per" placeholder="Annee" value="<?php if(!empty($annee_per)){ echo $annee_per; } ?>"require/></p>
         <p>Forfait <br><input type="text" name="forfait_km_per" placeholder="km" require/></p>
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
header("location: gestion/gestion_période?erreur=1"); 
}
}else{
header("location: connexion?erreur=1");
} 

?> 
</body>
</html>
