<?php
include '../connexion_dbh.php';
if(isset($_GET["email"])){ 
    $mail = $_GET["email"];
    if(isset($_SESSION['id_type_util']) == 1){
        $req_recup_info = $dbh->prepare("SELECT * FROM utilisateur WHERE email_util = ?");
        $req_recup_info->execute(array($mail));
        $resultat_req = $req_recup_info->fetch();

    if(isset($_POST["submit"])){ // Debut de la inscription
    
            $statut = htmlspecialchars($_POST['statut']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $nom = htmlspecialchars($_POST['nom']);
            $id_type_util = htmlspecialchars($_POST['id_type_util']);

            $req_update = $dbh->prepare("UPDATE utilisateur SET nom_util = ? , prenom_util = ? , statut_util = ? ,	id_type_util = ?  WHERE email_util = ? ");
            $req_update->execute(array($nom,$prenom,$statut,$id_type_util,$mail)); 
            $modifier = "<h5>L’utilisateur $nom a été modifié dans la FREDI</h5>";
    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification d'utilisateur</title>
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    </head>
    <header>
    <div class="menu">
    <ul>
    <li><a  href="index">Accueil</a></li>
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
          <h1>Modification d'utilisateur</h1>
            <br>
            <form method="post">
             <p>Prénom <br><input type="text" name="prenom" placeholder="Prénom" value="<?php if(!empty($resultat_req['prenom_util'])){ echo $resultat_req['prenom_util']; } ?>"require/></p>
             <p>Nom <br><input type="text" name="nom" placeholder="Nom" value="<?php if(!empty($resultat_req['nom_util'])){ echo $resultat_req['nom_util']; } ?>"require/></p>
             <p>Statut <br><input type="text" name="statut" placeholder="Statut" value="<?php echo $resultat_req['statut_util']; ?>"require/></p>
             <p>id_type_util <br><input type="text" name="id_type_util" placeholder="id_type_util" value="<?php if(!empty($resultat_req['id_type_util'])){ echo $resultat_req['id_type_util']; } ?>"require/></p>
             
             <br>
             <?php
             if(isset($erreur))
             {
                echo '<font color="red">'.$erreur."</font>";
             }
             if(isset($modifier))
             {
                echo '<font color="green">'.$modifier."</font>";
                exit;
             }
            ?>
            <input type="submit" name="submit" value="Modifier" />
            </form>
        </center>  
    </div>   
    <?php 
    }else{
    header("location: connexion?erreur=1");
    } ?> 
    </body>
    </html>   
<?php }else{
header('location: profil?mail='.$_SESSION['email_util'].''); 
}
?>