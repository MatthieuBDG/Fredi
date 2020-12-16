<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_ligne_de_frais.php'); 
}

    if(isset($_POST["submit"])){    
    
    $id_ldf = $_GET["id_ldf"];

    $req_rec_ldf = $dbh->prepare("SELECT * FROM ligne_de_frais WHERE id_ldf = ?");
    $req_rec_ldf->execute(array($id_ldf));
    $resultat_rec_ldf = $req_rec_ldf->fetch();

    $req_verif_periode = $dbh->prepare("SELECT * FROM periode WHERE annee_per = ?");
    $req_verif_periode->execute(array( $resultat_rec_ldf['annee_per']));
    $req_verif_periode = $req_verif_periode->fetch();
    $resultat_periode = $req_verif_periode['statut_per'];

    if($resultat_periode == 0){

    $sql= "DELETE FROM ligne_de_frais WHERE id_ldf = $id_ldf";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>La ligne de frais ".$resultat_rec_ldf['lib_trajet_ldf']." a été supprimé</p>";  
    } else {
      $erreur = "<p>La ligne de frais ".$resultat_rec_ldf['lib_trajet_ldf']." ne peut pas être supprimée car elle est associé à une période désactivée</p>";  
    }

}  
?>   
 
<center>
<?php if(!isset($supprimer) && !isset($erreur)) {?>
<h4>Voulez vous vraiment cloturé la ligne de frais ?</h4>
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