<?php
include '../connexion_dbh.php';

if(isset($_POST["back"])){
    header('location: gestion_motif_de_frais'); 
}
if(isset($_GET["id_mdf"])){ 
    $id_mdf = $_GET["id_mdf"];
    if($_SESSION['id_type_util'] == 1){
        $req_recup_info = $dbh->prepare("SELECT * FROM motif_de_frais WHERE id_mdf = ?");
        $req_recup_info->execute(array($id_mdf));
        $resultat_req = $req_recup_info->fetch();

        if(isset($_POST["back"])){
            header('location: gestion_motif_de_frais'); 
        }
    if(isset($_POST["submit"])){ // Debut de la inscription
        $lib_mdf = htmlspecialchars($_POST['lib_mdf']);
        $req_recup_lib_existe = $dbh->prepare("SELECT lib_mdf FROM motif_de_frais where lib_mdf = ?");
        $req_recup_lib_existe->execute(array($lib_mdf));
        $resultat_lib = $req_recup_lib_existe->fetch();
    if($resultat_lib == 0){
    if(!empty($lib_mdf)){
        
            $req_update = $dbh->prepare("UPDATE motif_de_frais SET lib_mdf = ? WHERE id_mdf = ? ");
            $req_update->execute(array($lib_mdf,$id_mdf)); 
            $modifier = "<h5>La période $lib_mdf a été modifié dans FREDI</h5>";
    
    }else{
        $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>";  
    }
    }else{
        $erreurlib_mdf = "<h5>$lib_mdf est dèja présent dans FREDI </h5>";  
        
    }

}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification de motif de frais</title>
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
             <p>Motif<br><input type="text" name="lib_mdf" placeholder="lib_mdf" value="<?php echo $resultat_req['lib_mdf']; ?>"require/></p>
            
             <br>
             <?php
             if(isset($erreur))
             {
                echo '<font color="red">'.$erreur."</font>";
             }
             if(isset($erreurlib_mdf))
             {
                echo '<font color="red">'.$erreurlib_mdf."</font>";?>
                <form method="post">
                <input type="submit" name="back" value="Retour" />
                </form>
                <?php
                exit;
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