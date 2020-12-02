<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_ligue.php'); 
}

    if(isset($_POST["submit"])){    
    
    $id_ligue = $_GET["id_ligue"];
    
    $req_rec_ligue = $dbh->prepare("SELECT * FROM ligue WHERE id_ligue = ?");
    $req_rec_ligue->execute(array($id_ligue));
    $resultat_rec_ligue = $req_rec_ligue->fetch();
    
    $req_verif_id_ligue = $dbh->prepare("SELECT * FROM ligue WHERE id_ligue = ?");
    $req_verif_id_ligue->execute(array($id_ligue));
    $resultat_id_ligue = $req_verif_id_ligue->rowCount();

    //if($resultat_id_ligue == 0){

    $sql= "DELETE FROM ligue WHERE id_ligue = $id_ligue";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>Le motif de frais ".$resultat_rec_ligue['lib_ligue']." a été supprimé</p>";  
          
    //}else{
    // $erreur =  "<p>Vous ne pouvez pas supprimer la ligue ".$resultat_rec_ligue['lib_ligue']." car un (ou plusieurs) club(s) l'utilise. </p>";  
    //}
    }
    
?>   
 
<center>
<?php if(!isset($supprimer) && !isset($erreur)) {?>
<h4>Voulez vous vraiment cloturé la ligue ?</h4>
<form method="post">
<input type="submit" name="back" value="Non" />
<input type="submit" name="submit" value="Oui" />
</form>
<?php }?>



<?php 
if(isset($supprimer))
{
echo '<font color="green">'.$supprimer."</font>"; ?>
<form method="post">
<input type="submit" name="back" value="Retour" />
</form>
<?php
exit;
}
if(isset($erreur))
{
echo '<font color="red">'.$erreur."</font>"; ?>
<form method="post">
<input type="submit" name="back" value="Retour" />
</form>
<?php
exit;
}
?>
</center>