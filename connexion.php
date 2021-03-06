<?php


include 'connexion_dbh.php';

if(isset($_GET["code"]) == "deconnexion"){ ?>
<center>
<?php echo "<font color='red'><h3>Déconnexion réussie</h3></font>"; ?>
</center>
<?php
}
if(isset($_GET["erreur"]) == "1"){ ?>
<center>
<?php echo "<font color='red'><h3>Vous devez d'abord vous connecter !</h3></font>"; ?>
</center>
<?php
}
if(isset($_SESSION['email_util'])) { 
$prenom = $_SESSION['prenom_util'];
$nom = $_SESSION['nom_util'];
$dejaconnexion = "<h3>$prenom $nom vous etes deja connecté</h3>";
}

if(isset($_POST["submit"])){ // Debut de la connexion

        $mailconnect = htmlspecialchars($_POST["mailconnect"]);
        $mdpconnect = htmlspecialchars($_POST["mdpconnect"]);

        if(!empty($mailconnect) AND !empty($mdpconnect)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur

        $req_connexion = $dbh->prepare("SELECT * FROM utilisateur WHERE email_util = ?");
        $req_connexion->execute(array($mailconnect));
        $resultat = $req_connexion->fetch();
        

        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($mdpconnect, $resultat['password_util']);

        if ($isPasswordCorrect == 1) {
        if($resultat['statut_util'] == 0){    
            
            $_SESSION['email_util'] = $mailconnect; //Definie le $_SESSION
            $_SESSION['id_type_util'] = $resultat['id_type_util']; //Definie le $_SESSION id_type_util
            $_SESSION['statut_util'] = $resultat['statut_util']; //Definie le $_SESSION statut_util
            $_SESSION['nom_util'] = $resultat['nom_util']; //Definie le $_SESSION nom_util
            $_SESSION['prenom_util'] = $resultat['prenom_util']; //Definie le $_SESSION prenom_util
            $mail = $_SESSION['email_util'];
            header("location: profil?mail=$mail");
        }else{
        $erreur = "<h5>Votre compte est désactivé !</h5>"; //message erreur
        }
        }else{
            $erreur = "<h5>Votre identifiant et / ou votre mot de passe est erroné</h5>"; //message erreur
        }  
    
    }else{
        $erreur = "<h5>Tous les champs doivent être complétés !</h5>"; //message erreur
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
    <title>Connexion</title>
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
if(!isset($dejaconnexion)){ ?>
<div class="connexion">
    <center>
      <h1>Connexion</h1>
        <br>
         <form method="post">
         <p>Adresse Mail <br><input type="email" name="mailconnect" placeholder="Adresse Mail" value="<?php if(!empty($mailconnect)){ echo $mailconnect; } ?>"require/></p>
         <p>Mot de passe <br><input type="password" name="mdpconnect" placeholder="Mot de passe" require/></p>
         <a href="recuperation" class="mot-de-passe-oublie">mot de passe oublié ?</a>
         <br>
        <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }if(isset($connexion))
         {
            echo '<font color="green">'.$connexion."</font>";
            exit;
         }
         
        ?>
        <input type="submit" name="submit" value="Connexion" />
        </form>
    </center>  
</div>    
<?php } ?>
</body>
</html>


        

      
      


