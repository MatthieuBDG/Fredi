<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_utilisateur'); 
}
    if(isset($_POST["submit"])){
    $sql= "UPDATE utilisateur SET statut_util = 1 WHERE email_util='".$_GET['email_util']."'";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>L'utilisateur a bien été désactivé</p>";    

    }
    
?>   
 
<center>
<?php if(!isset($supprimer)) {?>
<h4>Voulez vous vraiment supprimer l'utlilisateur ?</h4>
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