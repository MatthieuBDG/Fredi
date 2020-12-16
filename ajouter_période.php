<?php


include 'connexion_dbh.php';

if(isset($_POST["back"])){
    header('location: gestion/gestion_période'); 
}
if(isset($_SESSION['id_type_util']) == 1){
$req_recup_annee_existe = $dbh->prepare("SELECT * FROM periode where statut_per = 1");
$req_recup_annee_existe->execute(array());
$resultat_annee = $req_recup_annee_existe->rowCount();



if($resultat_annee == 0){
$req_recup_annee_all = $dbh->prepare("SELECT MAX(annee_per) AS annee_per FROM periode");
$req_recup_annee_all->execute(array());
$req_recup_annee_all = $req_recup_annee_all->fetch();
if(isset($_POST["submit"])){ // Debut de la inscription

        $annee_per = htmlspecialchars($_POST["annee_per"]);
        $forfait_km_per = htmlspecialchars($_POST["forfait_km_per"]);
        
        if(!empty($annee_per) AND !empty($forfait_km_per)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur
        if($forfait_km_per > 0){
        if($annee_per > $req_recup_annee_all['annee_per']){
        $req_verif_annee_inscription = $dbh->prepare("SELECT * FROM periode where annee_per = ?");
        $req_verif_annee_inscription->execute(array($annee_per));
        $resultat_annee = $req_verif_annee_inscription->rowCount();

        if($resultat_annee == 0){
        $req_ajout_periode = $dbh->prepare("INSERT INTO periode (annee_per,forfait_km_per,statut_per)VALUES (?,?,?)");
        $req_ajout_periode->execute(array($annee_per,$forfait_km_per,1)); 

        $inscription = "<h5>La période $annee_per a été créé dans la FREDI</h5>";
        
        }else{
            $erreur = "<h5> Vous ne pouvez pas créer la période $annee_per car une période active existe déjà </h5>"; //message erreur
        }
        }else{
            $erreur = "<h5> Vous ne pouvez pas créer la période $annee_per car l’année n’est pas valide </h5>"; //message erreur
        }
        }else{
            $erreur = "<h5> Vous ne pouvez pas créer la période $annee_per car la valeur des frais kilométriques n’est pas correcte</h5>"; //message erreur
        }
        
        }else{
            $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>"; //message erreur
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
         <p>Forfait <br><input type="text" name="forfait_km_per" placeholder="km" value="<?php if(!empty($forfait_km_per)){ echo $forfait_km_per; } ?>" require/></p>
         <br>
      
         <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         if(isset($inscription))
         {
            echo '<font color="green">'.$inscription."</font>"; ?>
            <form method="post">
            <input type="submit" name="back" value="Retour" />
            </form>
            <?php
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
