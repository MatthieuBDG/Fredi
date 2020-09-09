<?php


include 'connexion_dbh.php';


if(isset($_POST["submit"])){ // Debut de la connexion
        
        $mailconnect = htmlspecialchars($_POST["mailconnect"]);
        $mdpconnect = htmlspecialchars($_POST["mdpconnect"]);

        
        if(!empty($mailconnect) AND !empty($mdpconnect)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur

        $req_connexion = $dbh->prepare("SELECT email_util,password_util FROM utilisateur WHERE email_util = ?");
        $req_connexion->execute(array($mailconnect));
        $resultat = $req_connexion->fetch();


        // Comparaison du pass envoyé via le formulaire avec la base
        //$isPasswordCorrect = password_verify($mdpconnect, $resultat['password_util']);

        if ($mdpconnect == $resultat['password_util']) {
            
            session_start(); //connexion de l'utilisateur
            $_SESSION['email_util'] = $mailconnect; //Definie le $_SESSION
            
            header("Location:index");
        }else{
            $erreur = "<h5>Erreur de mot de passe/adresse mail !</h5>"; //message erreur
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
<body class="connexion">
<center>
<a href="index" id="bouton">accueil</a>    
</center>

<div class="connexion">
    <center>
      <h1>Connexion</h1>
        <br>
         <form method="post">
         <p>Adresse Mail <br><input type="email" name="mailconnect" placeholder="Adresse Mail" value="<?php echo $mailconnect ?>"require/></p>
         <p>Mot de passe <br><input type="password" name="mdpconnect" placeholder="Mot de passe" require/></p>
         <a href="recuperation" class="mot-de-passe-oublie">mot de passe oublié ?</a>
         <br>
         <p><a href="inscription">PAS ENCORE MEMBRE ?</a></p> 
        <br>
        <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
        ?>
        <input type="submit" name="submit" value="Connexion" />
        </form>
    </center>  
</div>    
</body>
</html>


        

      
      


