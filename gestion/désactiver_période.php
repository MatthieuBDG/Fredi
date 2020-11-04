<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_période'); 
}
    if(isset($_POST["submit"])){
    $sql= "UPDATE periode SET statut_per = 0 WHERE annee_per='".$_GET['annee_per']."'";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>La période a bien été désactivé</p>";    

    }
    
?>   
 
<center>
<?php if(!isset($supprimer)) {?>
<h4>Voulez vous vraiment supprimer la période ?</h4>
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
?>
</center>