<?php
include '../connexion_dbh.php';

if(isset($_POST["back"])){
    header('location: gestion_période'); 
}
if(isset($_GET["annee_per"])){ 
    $annee = $_GET["annee_per"];
    if($_SESSION['id_type_util'] == 1){
        $req_recup_info = $dbh->prepare("SELECT * FROM periode WHERE annee_per = ?");
        $req_recup_info->execute(array($annee));
        $resultat_req = $req_recup_info->fetch();

        if(isset($_POST["back"])){
            header('location: gestion_période'); 
        }
    if(isset($_POST["submit"])){ // Debut de la inscription
        $annee_per = htmlspecialchars($_POST['annee_per']);
        $forfait_km_per = htmlspecialchars($_POST['forfait_km_per']);
        $statut_per = htmlspecialchars($_POST['statut_per']);

        $req_recup_annee_existe = $dbh->prepare("SELECT annee_per FROM periode where annee_per = ?");
        $req_recup_annee_existe->execute(array($annee_per));
        $resultat_annee = $req_recup_annee_existe->rowCount();

        $req_recup_annee_active = $dbh->prepare("SELECT annee_per FROM periode where statut_per = ? and annee_per = ? ");
        $req_recup_annee_active->execute(array(1,$annee));
        $resultat_annee_active = $req_recup_annee_active->fetch();

    if($resultat_annee_active['statut_per'] == 0){
    if($resultat_annee == 0){    
    if($annee_per <= 0){
    if(!empty($annee_per) && !empty($forfait_km_per)){ 
        
            $req_update = $dbh->prepare("UPDATE periode SET annee_per = ? , forfait_km_per = ?,statut_per = ? WHERE annee_per = ? ");
            $req_update->execute(array($annee_per,$forfait_km_per,$statut_per,$annee)); 
            $modifier = "<h5>La période $annee_per a été modifié dans FREDI</h5>";
    }else{
        $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>";  
    }
    }else{
        $erreur = "<h5>Vous ne pouvez pas modifier la période $annee_per car l’année n’est pas valide </h5>"; 
    }
    }else{
        echo $resultat_annee_active['annee_per'];
        echo "<br>";
        echo $annee_per;
        echo "<br>";
        echo $resultat_annee_active['statut_per'];
        $erreur = "<h5>L'année $annee_per est dèja présent dans FREDI </h5>";  
        }    
       }else{
        $erreur =  "<h5>Il n’est pas possible de modifier l’année d’une période active</h5>";

    }
    
    
    
}
    
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification de période</title>
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    </head>
    <header>
    <div class="menu">
    <ul>
    <li><a  href="../index">Accueil</a></li>
    <?php if(!isset($_SESSION['email_util'])) { ?>
    <li><a class="active" href="../connexion">Connexion</a></li>
    <?php }else{ ?>
    <li><a href="../deconnexion">Deconnexion</a></li>
    <?php } ?>
    <li><a href="../#contact">Contact</a></li>
    <li><a  href="../#about">About</a></li>
    <?php if(isset($_SESSION['email_util'])) { ?>
    <li><a href="../profil?mail=<?php echo $_SESSION['email_util'] ?>"><?php echo $_SESSION['prenom_util']; ?></a></li>
    <?php } ?>
    </ul>     
    </div> 
    </header>
    <body class="connexion">
    <div class="connexion">
        <center>
          <h1>Modification de période</h1>
            <br>
            <form method="post"> 
             <p>Année<br><input type="text" name="annee_per" placeholder="annee_per" value="<?php if(!empty($resultat_req['annee_per'])){ echo $resultat_req['annee_per']; } ?>"require/></p>
             <p>Forfait<br><input type="text" name="forfait_km_per" placeholder="forfait_km_per" value="<?php echo $resultat_req['forfait_km_per']; ?>"require/></p>
             <p>Active<br><input type="text" name="statut_per" placeholder="Active" value="<?php echo $resultat_req['statut_per']; ?>"require/></p>
            
             <br>
             <?php
             if(isset($erreur))
             {
                echo '<font color="red">'.$erreur."</font>";
             }
             if(isset($modifier))
             {
                echo '<font color="green">'.$modifier."</font>"; ?>
                <form method="post">
                <input type="submit" name="back" value="Retour" />
                </form>
                <?php
                exit;
             }
            ?>
            <input type="submit" name="submit" value="Modifier" />
            </form>
        </center>  
    </div>   
    <?php 
    }else{
    header('location: ../profil?mail='.$_SESSION['email_util'].''); 
    } ?> 
    </body>
    </html>   
<?php }else{
header('location: ../profil?mail='.$_SESSION['email_util'].''); 
}
?>