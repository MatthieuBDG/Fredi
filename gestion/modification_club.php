<?php
include '../connexion_dbh.php';

if(isset($_GET["id_club"])){ 
    $id_club = $_GET["id_club"];
    if($_SESSION['id_type_util'] == 2){
        $req_recup_info = $dbh->prepare("SELECT * FROM club WHERE id_club = ?");
        $req_recup_info->execute(array($id_club));
        $resultat_req = $req_recup_info->fetch();

    if(isset($_POST["submit"])){ 
    
      $id_club = htmlspecialchars($_POST["id_club"]);
      $lib_club = htmlspecialchars($_POST["lib_club"]);
      $adr1_club = htmlspecialchars($_POST['adr1_club']);
      $adr2_club = htmlspecialchars($_POST['adr2_club']);
      $adr3_club = htmlspecialchars($_POST['adr3_club']);
      $adr3_club = htmlspecialchars($_POST['id_ligue']);
      

    $req_recup_club = $dbh->prepare("SELECT lib_club FROM club where id_club = ?");
    $req_recup_club->execute(array($lib_club));
    $resultat_club = $req_recup_club->rowCount();

    if($resultat_club == 0){
    if(!empty($lib_club) && !empty($id_club )&& !empty($adr1_club) && !empty($adr2_club) && !empty($adr3_club)&& !empty($id_ligue)){
        
            $req_update = $dbh->prepare("UPDATE club SET lib_club = ? , id_club = ? , adr1_club = ? , adr2_club = ? , adr3_club = ?, id_ligue = ? WHERE id_club = ".$id_club);
            $req_update->execute(array($lib_club,$id_club,$adr1_club,$adr2_club,$adr3_club,$id_club,$id_ligue)); 
            $modifier = "<h5>La période $lib_club a été modifié dans FREDI</h5>";
    
    }else{
        $erreur = "<h5>Vous ne pouvez pas modifier la club ".$lib_club." car une information n'a pas été saisie</h5>";  
    }
   }else{
       $erreur = "<h5>La club $lib_club est dèja présent dans FREDI </h5>";  
   }

}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification de club</title>
        <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    </head>
    <header>
    <div class="menu">
    <ul>
    <li><a  href="../index">Accueil</a></li>
    <?php if(!isset($_SESSION['adr3_club'])) { ?>
    <li><a class="active" href="../connexion">Connexion</a></li>
    <?php }else{ ?>
    <li><a href="../deconnexion">Deconnexion</a></li>
    <?php } ?>
    <li><a href="../#contact">Contact</a></li>
    <li><a  href="../#about">About</a></li>
    <?php if(isset($_SESSION['adr3_club'])) { ?>
    <li><a href="../profil?mail=<?php echo $_SESSION['adr3_club'] ?>"><?php echo $_SESSION['prenom_util']; ?></a></li>
    <?php } ?>
    </ul>     
    </div> 
    </header>
    <body class="connexion">
    <div class="connexion">
        <center>
          <h1>Modification de club</h1>
            <br>
            <form method="post"> 
            <p>id club<br><input type="text" name="id_club" placeholder="id_club" value="<?php if(!empty($id_club)){ echo $id_club; } ?>"require/></p>
            <p>lib club <br><input type="text" name="lib_club" placeholder="Lib club" value="<?php if(!empty($lib_club)){ echo $lib_club; } ?>"require/></p>
            <p>adrresse 1 <br><input type="text" name="adr1_club" placeholder="adr1_club" value="<?php if(!empty($adr1_club)){ echo $adr1_club; } ?>"require/></p>
            <p>adresse 2  <br><input type="text" name="adr2_club" placeholder="adr2_club" value="<?php if(!empty($adr2_club)){ echo $adr2_club; } ?>"require/></p>
            <p>adresse 3 <br><input type="text" name="adr3_club" placeholder="adr3_club" value="<?php if(!empty($adr3_club)){ echo $adr3_club; } ?>"require/></p>
            <p>id ligue  <br><input type="text" name="id_ligue" placeholder="id_ligue" value="<?php if(!empty($id_ligue)){ echo $id_ligue; } ?>"require/></p>
            
            
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
    header('location: ../profil?mail='.$_SESSION['adr3_club'].''); 
    } ?> 
    </body>
    </html>   
<?php }else{
header('location: ../profil?mail='.$_SESSION['adr3_club'].''); 
}
?>