<?php


include 'connexion_dbh.php';
include 'init.php';

$dao = new Motif_fraisDAO();
$motif_frais = $dao->findAll(); 

$dao1 = new PeriodeDAO();
$periode = $dao1->findAll(); 

$dao2 = new adherentDAO();
$adherent = $dao2->findAll(); 

if(isset($_POST["back"])){
    header('location: gestion/gestion_ligne_de_frais'); 
}

if(isset($_SESSION['id_type_util']) == 3){
if(isset($_POST["submit"])){ // Debut de la inscription
        
        

        $date_ldf = htmlspecialchars($_POST["date_ldf"]);
        $lib_trajet_ldf = htmlspecialchars($_POST["lib_trajet_ldf"]);
        $cout_peage_ldf = htmlspecialchars($_POST["cout_peage_ldf"]);
        $cout_repas_ldf = htmlspecialchars($_POST["cout_repas_ldf"]);
        $cout_hebergement_ldf = htmlspecialchars($_POST["cout_hebergement_ldf"]);
        $nb_km_ldf = htmlspecialchars($_POST["nb_km_ldf" ]);
        $id_mdf = htmlspecialchars($_POST["id_mdf"]);
        $annee_per = htmlspecialchars($_POST["annee_per"]);
        $email_util = htmlspecialchars($_POST["email_util"]);

        $tarif_km = $dbh->prepare("SELECT forfait_km_per FROM periode WHERE annee_per = ?");
        $tarif_km->execute(array($annee_per)); 
        $tarif_km = $tarif_km->fetch();

        $total_km_ldf = $nb_km_ldf*2;
        $total_ldf = ($total_km_ldf * $tarif_km['forfait_km_per']) + $cout_hebergement_ldf + $cout_repas_ldf + $cout_peage_ldf;

        if(!empty($date_ldf) || !empty($lib_trajet_ldf) || !empty($cout_peage_ldf) || !empty($cout_repas_ldf) || !empty($cout_hebergement_ldf)
        || !empty($nb_km_ldf) || !empty($total_km_ldf) || !empty($total_ldf) || !empty($id_mdf) 
        || !empty($annee_per) || !empty($email_util)) { //Verifie si les champs ne sont pas vide sinon affiche message erreur
        

        $req_ajout_ligue_de_frais = $dbh->prepare("INSERT INTO ligne_de_frais (date_ldf,lib_trajet_ldf,
        cout_peage_ldf,cout_repas_ldf,cout_hebergement_ldf,nb_km_ldf,total_km_ldf,total_ldf,id_mdf,annee_per,email_util)
        VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $req_ajout_ligue_de_frais->execute(array($date_ldf,$lib_trajet_ldf,$cout_peage_ldf,$cout_repas_ldf,
        $cout_hebergement_ldf,$nb_km_ldf,$total_km_ldf,$total_ldf,$id_mdf,$annee_per,$email_util)); 

        $inscription = "<h5>Le motif de frais $lib_trajet_ldf a été créé dans
        l’application FREDI</h5>";

        }else{
            $erreur = "<h5>Saisie du libellé obligatoire pour créer le motif de frais</h5>"; //message erreur
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de ligne de frais</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>
<header>
<div class="menu">
<ul>
<li><a  href="index">Accueil</a></li>
<?php if(!isset($_SESSION['email_util'])) { ?>
<li><a class="active" href="connexion">Connexion</a></li>
<?php }else{ ?>
<li><a href="deconnexion">Deconnexion</a></li>
<?php } ?>
<li><a href="#contact">Contact</a></li>
<li><a  href="#about">About</a></li>
<?php if(isset($_SESSION['email_util'])) { ?>
<li><a href="profil?mail=<?php echo $_SESSION['email_util'] ?>"><?php echo $_SESSION['prenom_util']; ?></a></li>
<?php } ?>
</ul>     
</div> 
</header>
<body class="connexion">
<div class="connexion">
    <center>
      <h1>Ajout de ligne de frais</h1>
        <br>
         <form method="post">
         <p>Date<br><input type="date" name="date_ldf" placeholder="Date" value="<?php if(!empty($date_ldf)){ echo $date_ldf; } ?>"require/></p>
         <p>Nom Trajet<br><input type="text" name="lib_trajet_ldf" placeholder="Nom" value="<?php if(!empty($lib_trajet_ldf)){ echo $lib_trajet_ldf; } ?>"require/></p>
         <p>Cout peage<br><input type="text" name="cout_peage_ldf" placeholder="Cout" value="<?php if(!empty($cout_peage_ldf)){ echo $cout_peage_ldf; } ?>"require/></p>
         <p>Cout repas<br><input type="text" name="cout_repas_ldf" placeholder="Cout" value="<?php if(!empty($cout_repas_ldf)){ echo $cout_repas_ldf; } ?>"require/></p>
         <p>Cout hebergement<br><input type="text" name="cout_hebergement_ldf" placeholder="Cout" value="<?php if(!empty($cout_hebergement_ldf)){ echo $cout_hebergement_ldf; } ?>"require/></p>
         <p>Nombre km<br><input type="text" name="nb_km_ldf" placeholder="Nombre km" value="<?php if(!empty($nb_km_ldf)){ echo $nb_km_ldf; } ?>"require/></p>
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
         <p>Adresse mail adherent</p>
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
         if(isset($inscription))
         {
            echo '<font color="green">'.$inscription."</font>"; ?>
            <form method="post">
            <input type="submit" name="back" value="Retour" />
            </form>
            <?php
            exit;
         }
        ?>
        <input type="submit" name="submit" value="Ajouter" />
        </form>
    </center>  
</div>   
<?php 
}else{
header("location: connexion?erreur=1");
} ?> 
</body>
</html>
