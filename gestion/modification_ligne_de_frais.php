<?php
include '../connexion_dbh.php';
include '../init.php';

$dao = new Motif_fraisDAO();
$motif_frais = $dao->findAll(); 

$dao2 = new PeriodeDAO();
$periode = $dao2->findAll();

$dao3 = new adherentDAO();
$adherent = $dao3->findAll();


if(isset($_POST["back"])){
    header('location: gestion_ligne_de_frais'); 
}
if(isset($_GET["id_ldf"])){ 
    $id_ldf = $_GET["id_ldf"];
    if($_SESSION['id_type_util'] == 3){
        $req_recup_info = $dbh->prepare("SELECT * FROM ligne_de_frais WHERE id_ldf = ?");
        $req_recup_info->execute(array($id_ldf));
        $resultat_req = $req_recup_info->fetch();

        if(isset($_POST["back"])){
            header('location: gestion_ligne_de_frais'); 
        }
    if(isset($_POST["submit"])){ // Debut de la inscription

        $date_ldf = htmlspecialchars($_POST['date_ldf']);        
        $lib_trajet_ldf = htmlspecialchars($_POST['lib_trajet_ldf']);
        $cout_peage_ldf = htmlspecialchars($_POST['cout_peage_ldf']);
        $cout_repas_ldf = htmlspecialchars($_POST['cout_repas_ldf']);
        $cout_hebergement_ldf =  htmlspecialchars($_POST['cout_hebergement_ldf']);
        $nb_km_ldf = htmlspecialchars($_POST['nb_km_ldf']);
        $total_km_ldf = htmlspecialchars($_POST['total_km_ldf']);
        $total_ldf = htmlspecialchars($_POST['total_ldf']);
        $id_mdf = htmlspecialchars($_POST['id_mdf']);
        $annee_per = htmlspecialchars($_POST['annee_per']);
        $email_util = htmlspecialchars($_POST['email_util']);


    if(!empty($lib_trajet_ldf) && !empty($date_ldf) && !empty($cout_peage_ldf) && !empty($cout_repas_ldf) && !empty($cout_hebergement_ldf) && !empty($nb_km_ldf) &&
     !empty($total_km_ldf) && !empty($total_ldf) && !empty($id_mdf) && !empty($annee_per) && !empty($email_util)){
        if($cout_peage_ldf >= 0 && $cout_repas_ldf >= 0 &&  $cout_hebergement_ldf >= 0 && $nb_km_ldf >= 0){
        
            $req_update = $dbh->prepare("UPDATE ligne_de_frais SET date_ldf = ?,lib_trajet_ldf = ?,cout_peage_ldf = ?,cout_repas_ldf = ?,
            cout_hebergement_ldf = ?,nb_km_ldf = ?,total_km_ldf = ?,total_ldf = ?,id_mdf = ?,annee_per = ?,email_util = ? WHERE id_ldf = ? ");
            $req_update->execute(array($date_ldf,$lib_trajet_ldf,$cout_peage_ldf,$cout_repas_ldf,$cout_hebergement_ldf,$nb_km_ldf,$total_km_ldf,
            $total_ldf,$id_mdf,$annee_per,$email_util,$id_ldf)); 

            $modifier = "<h5>Le trajet $lib_trajet_ldf a été modifié dans FREDI</h5>";
    }else{
        $erreur = "<h5> La ligne de frais ne peut être modifiée : des informations sont invalides</h5>";  
    }
    }else{
        $erreur = "<h5>La ligne de frais ne peut être modifiée : des informations sont invalides</h5>";  
    }
}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modification de ligne de frais</title>
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
          <h1>Modification de ligne de frais</h1>
            <br>
            <form method="post"> 
             <p>Date<br><input type="date" name="date_ldf" placeholder="date_ldf" value="<?php echo $resultat_req['date_ldf']; ?>"require/></p>
             <p>Nom trajet<br><input type="text" name="lib_trajet_ldf" placeholder="lib_trajet_ldf" value="<?php echo $resultat_req['lib_trajet_ldf']; ?>"require/></p>
             <p>Cout péage<br><input type="text" name="cout_peage_ldf" placeholder="cout_peage_ldf" value="<?php echo $resultat_req['cout_peage_ldf']; ?>"require/></p>
             <p>Cout repas<br><input type="text" name="cout_repas_ldf" placeholder="cout_repas_ldf" value="<?php echo $resultat_req['cout_repas_ldf']; ?>"require/></p>
             <p>Cout hebergement<br><input type="text" name="cout_hebergement_ldf" placeholder="cout_hebergement_ldf" value="<?php echo $resultat_req['cout_hebergement_ldf']; ?>"require/></p>
             <p>Nombre de trajet (km)<br><input type="text" name="nb_km_ldf" placeholder="nb_km_ldf" value="<?php echo $resultat_req['nb_km_ldf']; ?>"require/></p>
             <p>Total nombre de trajet (km)<br><input type="text" name="total_km_ldf" placeholder="total_km_ldf" value="<?php echo $resultat_req['total_km_ldf']; ?>"require/></p>
             <p>Total<br><input type="text" name="total_ldf" placeholder="total_ldf" value="<?php echo $resultat_req['total_ldf']; ?>"require/></p>
             <p>Motif de frais</p>
            <select name="id_mdf">
            <?php
            foreach ($motif_frais as $motif_frais) {
                echo '<option value='.$motif_frais->get_id_mdf().'>'.$motif_frais->get_lib_mdf().'</option>';
                }
            ?>
         </select>
         <p>Periode</p>
            <select name="annee_per">
            <?php
            foreach ($periode as $periode) {
                echo '<option value='.$periode->get_annee_per().'>'.$periode->get_annee_per().'</option>';
                }
            ?>
         </select>
         <p>Adherent</p>
            <select name="email_util">
            <?php
            foreach ($adherent as $adherent) {
                echo '<option value='.$adherent->get_email_util().'>'.$adherent->get_email_util().'</option>';
                }
            ?>
         </select>

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