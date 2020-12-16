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

    $req_verif_ligue_club = $dbh->prepare("SELECT * FROM club WHERE id_ligue = ?");
    $req_verif_ligue_club->execute(array($id_ligue));
    $resultat_ligue = $req_verif_ligue_club->rowCount();

    if($resultat_ligue == 0){


    $sql= "DELETE FROM ligue WHERE id_ligue = $id_ligue";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>La ligue ".$resultat_rec_ligue['lib_ligue']." a été supprimée</p>";  
    }else{
     $erreur =  "<p>La ligue ".$resultat_rec_ligue['lib_ligue']." ne peut pas être supprimée car au moins un club y est affilié </p>";  

    }

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