<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_club.php'); 
}

    if(isset($_POST["submit"])){    
    
    $id_club = $_GET["id_club"];

    $req_rec_club = $dbh->prepare("SELECT * FROM club WHERE id_club = ?");
    $req_rec_club->execute(array($id_club));
    $resultat_rec_club = $req_rec_club->fetch();

    $req_verif_adherent_club = $dbh->prepare("SELECT * FROM adherent WHERE id_club = ?");
    $req_verif_adherent_club->execute(array($id_club));
    $resultat_adherent = $req_verif_adherent_club->rowCount();

    if($resultat_adherent == 0){

    $sql= "DELETE FROM club WHERE id_club = $id_club";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>Le club ".$resultat_rec_club['lib_club']." a été supprimé</p>";  
    }else{
     $erreur =  "<p>Le club ".$resultat_rec_club['lib_club']." ne peut pas être supprimé car au moins un
     adhérent y est affilié</p>";  

    }

}  
?>   
 
<center>
<?php if(!isset($supprimer) && !isset($erreur)) {?>
<h4>Voulez vous vraiment supprime le club ?</h4>
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