<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_motif_de_frais'); 
}

    if(isset($_POST["submit"])){    
    
    $id_mdf = $_GET['id_mdf'];
    
    $req_rec_motif_de_frais = $dbh->prepare("SELECT * FROM motif_de_frais WHERE id_mdf = ?");
    $req_rec_motif_de_frais->execute(array($id_mdf));
    $resultat_rec_motif_de_frais = $req_rec_motif_de_frais->fetch();
    
    $req_verif_id_mdf_note_de_frais = $dbh->prepare("SELECT * FROM ligne_de_frais WHERE id_mdf = ?");
    $req_verif_id_mdf_note_de_frais->execute(array($id_mdf));
    $resultat_id_mdf = $req_verif_id_mdf_note_de_frais->rowCount();
    if($resultat_id_mdf == 0){


    $sql= "DELETE FROM motif_de_frais WHERE id_mdf = $id_mdf";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>Le motif de frais ".$resultat_rec_motif_de_frais['lib_mdf']." a été supprimé</p>";        
    }else{
    $erreur =  "<p>Vous ne pouvez pas supprimer le motif de frais ".$resultat_rec_motif_de_frais['lib_mdf']." car une (ou plusieurs) note de frais l’utilise</p>";  
    }


    }
    
?>   
 
<center>
<?php if(!isset($supprimer) && !isset($erreur) ) {?>
<h4>Voulez vous vraiment cloturé le motif de frais ?</h4>
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