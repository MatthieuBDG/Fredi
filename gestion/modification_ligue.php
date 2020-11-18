<?php
include '../connexion_dbh.php';

if(isset($_GET["id_ligue"])){ 
    $id_ligue = $_GET["id_ligue"];
    if($_SESSION['id_type_util'] == 2){
        $req_recup_info = $dbh->prepare("SELECT * FROM ligue WHERE id_ligue = ?");
        $req_recup_info->execute(array($id_ligue));
        $resultat_req = $req_recup_info->fetch();

    if(isset($_POST["submit"])){ // Debut de la inscription

      $id_ligue = htmlspecialchars($_POST["id_ligue"]);
      $lib_ligue = htmlspecialchars($_POST["lib_ligue"]);
      $url_ligue = htmlspecialchars($_POST["url_ligue"]);
      $contact_ligue = htmlspecialchars($_POST['contact_ligue']);
      $telephone_ligue = htmlspecialchars($_POST['telephone_ligue']);
      $email_util = htmlspecialchars($_POST['email_util']);

        $req_recup_ligue = $dbh->prepare("SELECT id_ligue FROM ligue where id_ligue = ?");
        $req_recup_ligue->execute(array($id_ligue));
        $resultat_ligue = $req_recup_ligue->fetch();
    if($resultat_ligue == 0){
    if(!empty($lib_ligue) && !empty($url_ligue )&& !empty($contact_ligue) && !empty($telephone_ligue) && !empty($email_util)){
        
            $req_update = $dbh->prepare("UPDATE ligue SET lib_ligue = ? , url_ligue = ? , contact_ligue = ? , telephone_ligue = ? , email_util = ? WHERE id_ligue = ? ");
            $req_update->execute(array($lib_ligue,$url_ligue,$contact_ligue,$telephone_ligue,$email_util)); 
            $modifier = "<h5>La période $lib_ligue a été modifié dans FREDI</h5>";
    
    }else{
        $erreur = "<h5>Une information obligatoire n’a pas été saisie</h5>";  
    }
    }else{
        $erreur = "<h5>L'année $lib_ligue est dèja présent dans FREDI </h5>";  
    }

}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification de ligue</title>
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
          <h1>Modification de ligue</h1>
            <br>
            <form method="post"> 
            <p>lib ligue <br><input type="text" name="lib_ligue" placeholder="Lib ligue" value="<?php if(!empty($lib_ligue)){ echo $lib_ligue; } ?>"require/></p>
            <p>url ligue <br><input type="text" name="url_ligue" placeholder="url_ligue" value="<?php if(!empty($url_ligue)){ echo $url_ligue; } ?>"require/></p>
            <p>contact ligue <br><input type="text" name="contact_ligue" placeholder="contact_ligue" value="<?php if(!empty($contact_ligue)){ echo $contact_ligue; } ?>"require/></p>
            <p>telephone ligue <br><input type="text" name="telephone_ligue" placeholder="telephone_ligue" value="<?php if(!empty($telephone_ligue)){ echo $telephone_ligue; } ?>"require/></p>
            <p>email ligue <br><input type="email" name="email_util" placeholder="email_util" value="<?php if(!empty($email_util)){ echo $email_util; } ?>"require/></p>
            
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