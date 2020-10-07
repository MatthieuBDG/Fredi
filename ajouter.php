<?php


include 'connexion_dbh.php';

if(isset($_SESSION['id_type_util']) == 1){
if(isset($_POST["submit"])){ // Debut de la inscription

        $mailconnect = htmlspecialchars($_POST["mailconnect"]);
        $mdpconnect = htmlspecialchars($_POST["mdpconnect"]);
        $type_user = htmlspecialchars($_POST['type_user']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);

        if(!empty($mailconnect) AND !empty($mdpconnect) AND isset($type_user)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur
        
        $req_verif_email_inscription = $dbh->prepare("SELECT * FROM utilisateur WHERE email_util = ?");
        $req_verif_email_inscription->execute(array($mailconnect));
        $resultat_email = $req_verif_email_inscription->rowCount();

        if($resultat_email == 0){
        $hashPassword = password_hash($mdpconnect, PASSWORD_DEFAULT);
        if($type_user == 2){
        $longueurKey = 3;
        $genere_code = "";
        for($i=0;$i<$longueurKey;$i++) {
        $genere_code .= mt_rand(0,9);
        }
        $req_verif_statut_util_inscription = $dbh->prepare("SELECT * FROM utilisateur WHERE matricule_cont = ?");
        $req_verif_statut_util_inscription->execute(array($genere_code));
        $resultat_statut_util = $req_verif_statut_util_inscription->rowCount();
        if($resultat_statut_util == 1){
        $longueurKey = 3;
        $genere_code = "";
        for($i=0;$i<$longueurKey;$i++) {
        $genere_code .= mt_rand(0,9);
            }  
        }
        $req_inscription = $dbh->prepare("INSERT INTO utilisateur (email_util,password_util,nom_util,prenom_util,statut_util,matricule_cont,id_type_util)VALUES (?,?,?,?,?,?,?)");
        $req_inscription->execute(array($mailconnect,$hashPassword,$nom,$prenom,0,$genere_code,$type_user)); 
        
        }else{
        $req_inscription = $dbh->prepare("INSERT INTO utilisateur (email_util,password_util,nom_util,prenom_util,statut_util,matricule_cont,id_type_util)VALUES (?,?,?,?,?,?,?)");
        $req_inscription->execute(array($mailconnect,$hashPassword,$nom,$prenom,0,0,$type_user));   
        }
        $inscription = "<h4>L’utilisateur $nom a été créé dans la FREDI</h4>"; //message inscription
        }else{
            $erreur = "<h5>Cette adresse mail est déjà utilisée</h5>"; //message erreur
        }
    
    }else{
        $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>"; //message erreur
    }

}
    $longueurKey = 15;
    $key = "";
    for($i=1;$i<$longueurKey;$i++) {
       $key .= mt_rand(0,9);
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

<?php
if(isset($dejaconnexion))
{
echo "<center>";
echo "$dejaconnexion";
echo "<br><br>";
echo '<a href="deconnexion" id="bouton">Se déconnecter</a>';
echo "</center>";
exit;
}
?>
<div class="connexion">
    <center>
      <h1>Inscription</h1>
        <br>
         <form method="post">
         <label for="user-select">Type utilisateur :</label>
        <select name="type_user" id="type_user">
        <option value="2">Contoleur</option>
        <option value="3">Adherent</option>
        <option value="1">Adminitrateur</option>
        </select>
         <p>Prénom <br><input type="text" name="prenom" placeholder="Prénom" value="<?php if(!empty($prenom)){ echo $prenom; } ?>"require/></p>
         <p>Nom <br><input type="text" name="nom" placeholder="Nom" value="<?php if(!empty($nom)){ echo $nom; } ?>"require/></p>
         <p>Adresse Mail <br><input type="email" name="mailconnect" placeholder="Adresse Mail" value="<?php if(!empty($mailconnect)){ echo $mailconnect; } ?>"require/></p>
         <p>Mot de passe <br><input type="password" name="mdpconnect" placeholder="Mot de passe" require/></p>
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
        <input type="submit" name="submit" value="inscription" />
        </form>
    </center>  
</div>    
<?php 
}else{
header("location: connexion?erreur=1");
} ?>
</body>
</html>


        

      
      


