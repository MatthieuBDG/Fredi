<?php
session_start();  // démarrage d'une session

$submit = $_POST["submit"];

if($submit){
        
        $mailconnect = htmlspecialchars($_POST["mailconnect"]);
        $mdpconnect = htmlspecialchars($_POST["mdpconnect"]);

        if(!empty($mailconnect) AND !empty($mdpconnect)) {

        $req = $dbh->prepare("SELECT Mail,Mdp FROM Members WHERE Mail = ?");
        $req->execute(array($mailconnect));
        $resultat = $req->fetch();


        // Comparaison du pass envoyé via le formulaire avec la base
        $isPasswordCorrect = password_verify($mdpconnect, $resultat['Mdp']);

        if ($isPasswordCorrect == 1) {
 
            session_start(); 
            $_SESSION['Mail'] = $mailconnect;

            $Mail = $_SESSION['Mail'];


        }  
    }else{
        $erreur = "<h5>Erreur de mot de passe/adresse mail !</h5>";
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


        

      
      


