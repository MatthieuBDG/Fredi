<?php


include 'connexion_dbh.php';

if(isset($_SESSION['id_type_util']) == 1){
if(isset($_POST["submit"])){ // Debut de la inscription

        $lib_mdf = htmlspecialchars($_POST["lib_mdf"]);

        if(!empty($lib_mdf)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur
        
        $req_verif_lib_mdf_inscription = $dbh->prepare("SELECT * FROM motif_de_frais WHERE lib_mdf = ?");
        $req_verif_lib_mdf_inscription->execute(array($lib_mdf));
        $resultat_lib_mdf = $req_verif_lib_mdf_inscription->rowCount();

        if($resultat_lib_mdf == 0){
        $req_ajout_motif_de_frais = $dbh->prepare("INSERT INTO motif_de_frais (lib_mdf)VALUES (?)");
        $req_ajout_motif_de_frais->execute(array($lib_mdf)); 

        $inscription = "<h5>Le motif de frais $lib_mdf a été créé dans
        l’application FREDI</h5>";
        
        }else{
            $erreur = "<h5> Vous ne pouvez pas créer la période $lib_mdf car une
            période active existe déjà </h5>"; //message erreur
        }
        }else{
            $erreur = "<h5>Saisie du libellé obligatoire pour créer le motif de frais</h5>"; //message erreur
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de motif de frais</title>
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
      <h1>Ajout de motif de frais</h1>
        <br>
         <form method="post">
         <p>Nom <br><input type="text" name="lib_mdf" placeholder="Nom" value="<?php if(!empty($lib_mdf)){ echo $lib_mdf; } ?>"require/></p>
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
