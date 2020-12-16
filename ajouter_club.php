<?php




include 'connexion_dbh.php';
include 'init.php';

$dao = new ligueDAO();
$ligues = $dao->findAll(); 

if(isset($_POST["back"])){
    header('location: gestion/gestion_club'); 
}
if(isset($_SESSION['id_type_util']) == 2){
if(isset($_POST["submit"])){ // Debut de la inscription

        $lib_club = htmlspecialchars($_POST["lib_club"]);
        $adr1_club = htmlspecialchars($_POST["adr1_club"]);	
        $adr2_club = htmlspecialchars($_POST["adr2_club"]);
        $adr3_club = htmlspecialchars($_POST["adr3_club"]);
        $id_ligue = htmlspecialchars($_POST["id_ligue"]);

        if(!empty($lib_club) || !empty($adr1_club) || !empty($adr2_club) || !empty($adr3_club) || !empty($id_ligue) ) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur
        $req_verif_lib_club_inscription = $dbh->prepare("SELECT * FROM club WHERE lib_club = ?");
        $req_verif_lib_club_inscription->execute(array($lib_club));
        $resultat_lib_club = $req_verif_lib_club_inscription->rowCount();

        if($resultat_lib_club == 0){
        $req_ajout_club = $dbh->prepare("INSERT INTO club (lib_club,adr1_club,adr2_club,adr3_club,id_ligue)VALUES (?,?,?,?,?)");
        $req_ajout_club->execute(array($lib_club,$adr1_club,$adr2_club,$adr3_club,$id_ligue)); 

        $inscription = "<h5>Le club $lib_club a été créé dans l’application FREDI </h5>";
        
        }else{
            $erreur = "<h5>Vous ne pouvez pas créer le club $lib_club car il existe déjà </h5>"; //message erreur
        }
        }else{
            $erreur = "<h5>Vous ne pouvez pas créer le club $lib_club car une information n’a pas été saisie </h5>"; //message erreur
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de club</title>
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
      <h1>Ajout de club</h1>
        <br>
         <form method="post">
         <p>Nom du club <br><input type="text" name="lib_club" placeholder="Nom" value="<?php if(!empty($lib_club)){ echo $lib_club; } ?>"required/></p>
         <p>Adresse 1 <br><input type="text" name="adr1_club" placeholder="adresse 1" value="<?php if(!empty($adr1_club)){ echo $adr1_club; } ?>"required/></p>
         <p>Adresse 2 <br><input type="text" name="adr2_club" placeholder="adresse 2" value="<?php if(!empty($adr2_club)){ echo $adr2_club; } ?>"required/></p>
         <p>Adresse 3 <br><input type="text" name="adr3_club" placeholder="adresse 3" value="<?php if(!empty($adr3_club)){ echo $adr3_club; } ?>"required/></p>
         <p>Ligues</p>
         <select name="id_ligue">
         <?php
            foreach ($ligues as $ligue) {
                echo '<option value='.$ligue->get_id_ligue().'>'.$ligue->get_lib_ligue().'</option>';  
            }
         ?>
      </select>
        
         <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         if(isset($inscription))
         {
            echo '<font color="green">'.$inscription."</font>";?>
            <form method="post">
            <input type="submit" name="back" value="Retour" />
            </form>
            <?php
            exit;
         }
        ?>
        <br><br>
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
