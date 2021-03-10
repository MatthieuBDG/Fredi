<?php
include '../connexion_dbh.php';

if(isset($_GET["email"])){ 
    $mail = $_GET["email"];
    if($_SESSION['id_type_util'] == 1){
        $req_recup_info = $dbh->prepare("SELECT * FROM utilisateur WHERE email_util = ?");
        $req_recup_info->execute(array($mail));
        $resultat_req = $req_recup_info->fetch();

        if(isset($_POST["back"])){
            header('location: gestion_adherent'); 
        }
    if(isset($_POST["submit"])){ // Debut de la inscription
        $id_type_util = htmlspecialchars($_POST['id_type_util']);
        $statut = htmlspecialchars($_POST['statut']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
    if($id_type_util == 1 || $id_type_util == 2 || $id_type_util == 3){
    if(!empty($prenom) && !empty($nom)){
        
            $req_update = $dbh->prepare("UPDATE adherent SET nom_util = ? , prenom_util = ? , statut_util = ? ,	id_type_util = ?  WHERE email_util = ? ");
            $req_update->execute(array($nom,$prenom,$statut,$id_type_util,$mail)); 
            $modifier = "<h5>L'adhérent $nom a été modifié dans la FREDI</h5>";
    }else{
        $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>";  
    }
    }else{
        $erreur = "<h5>Erreur Type utlisateur doit etre compris entre 1 et 3</h5>";
    }
    
}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification d'adhérent</title>
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
          <h1>Modification d'adhérent</h1>
            <br>
            <form method="post">
             <p>Prénom <br><input type="text" name="prenom" placeholder="Prénom" value="<?php if(!empty($resultat_req['prenom_util'])){ echo $resultat_req['prenom_util']; } ?>"require/></p>
             <p>Nom <br><input type="text" name="nom" placeholder="Nom" value="<?php if(!empty($resultat_req['nom_util'])){ echo $resultat_req['nom_util']; } ?>"require/></p>
             <p>Statut <br><input type="text" name="statut" placeholder="Statut" value="<?php echo $resultat_req['statut_util']; ?>"require/></p>
             <p>Statut <br><input type="text" name="statut" placeholder="Statut" value="<?php echo $resultat_req['statut_util']; ?>"require/></p>
             <p>Statut <br><input type="text" name="statut" placeholder="Statut" value="<?php echo $resultat_req['statut_util']; ?>"require/></p>
             <p>Statut <br><input type="text" name="statut" placeholder="Statut" value="<?php echo $resultat_req['statut_util']; ?>"require/></p>
             <p>Type Utilisateur<br><input type="text" name="id_type_util" placeholder="id_type_util" value="<?php if(!empty($resultat_req['id_type_util'])){ echo $resultat_req['id_type_util']; } ?>"require/></p>
             
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