<?php
include '../connexion_dbh.php';
include ("../init.php");
if(isset($_POST["back"])){
    header('location: gestion_période'); 
}
    if(isset($_POST["submit"])){
    $annee_per = $_GET['annee_per'];

    
    $req_verif_annee_per_note_de_frais = $dbh->prepare("SELECT * FROM ligne_de_frais WHERE annee_per = ?");
    $req_verif_annee_per_note_de_frais->execute(array($annee_per));
    $resultat_annee_per = $req_verif_annee_per_note_de_frais->rowCount();

    if($resultat_annee_per == 0){
    
    $sql= "UPDATE periode SET statut_per = 0 WHERE annee_per=$annee_per";
    try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    } catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    $supprimer =  "<p>La période $annee_per a été cloturé</p>";    

    }else{
    $erreur =  "<p>Vous ne pouvez pas supprimer la periode $annee_per car une (ou plusieurs) note de frais l’utilise</p>";  
    }
}
?>   
 
<center>
<?php if(!isset($supprimer) && !isset($erreur)) {?>
<h4>Voulez vous vraiment cloturé la période ?</h4>
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