<?php

include 'connexion_dbh.php'; //connexion base de données

session_start();  // démarrage d'une session

$submit = $_POST["submit"];

if($submit){ // Debut de la connexion
        
        $mailconnect = htmlspecialchars($_POST["mailconnect"]);
        $mdpconnect = htmlspecialchars($_POST["mdpconnect"]);

        
        if(!empty($mailconnect) AND !empty($mdpconnect)) { //Verifie si le champs adresse mail et mot de passe n'est pas vide sinon affiche message erreur

        $req_connexion = $dbh->prepare("SELECT Mail,Mdp FROM Members WHERE Mail = ?");
        $req_connexion->execute(array($mailconnect));
        $resultat = $req_connexion->fetch();


        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($mdpconnect, $resultat['Mdp']);

        if ($isPasswordCorrect == 1) {
            
            session_start(); //connexion de l'utilisateur
            $_SESSION['Mail'] = $mailconnect; //Definie le $_SESSION
            

        }  
    }else{
        $erreur = "<h5>Erreur de mot de passe/adresse mail !</h5>"; //message erreur
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/styles.css" media="screen" type="text/css" />
</head>
<body class="connexion">

<div class="connexion">
    <center>
      <h1>Connexion</h1>
        <br>
         <form method="post">
         <p>Adresse Mail <br><input type="email" name="mailconnect" placeholder="Adresse Mail" require/></p>
         <p>Mot de passe <br><input type="password" name="mdpconnect" placeholder="Mot de passe" require/></p>
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


        

      
      


