<?php
session_start();
/**
 * Liste des pays en PDF
 */
require_once "../init.php";
require_once "../fpdf/fpdf.php";

$id = isset($_GET['id']) ? $_GET['id']: 0;
$userDAO = new UtilisateurDAO;
$user = $userDAO->find($id); //renvoie l'utilisateur concerné
$adhDAO = new AdherentDAO;
$adh = $adhDAO->find($id);
$clubDAO = new ClubDAO;
$club = $clubDAO->find($adh->get_id_club());
$ldfDAO = new Ligne_de_fraisDAO;
$periodeDAO = new PeriodeDAO;
$per = $periodeDAO->findPeriodeActive();
$ldfs=array();
$ldfs = $ldfDAO->findMailPeriode($id, $per->get_annee_per()); // renvoi les lignes de frais de l'utilisateur sur la périuode active
$motifDAO = new Motif_fraisDAO;


$date = date('d/m/Y');
define('EURO'," ".utf8_encode(chr(128))); // créé la constante pour le symbole ascii euro (sinon probleme d'affichage)

// Crée le tableau d'objets métier 




// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();   // Paysage

// Metadonnées
$pdf->SetTitle('noteDeDrais', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('bandereau', true);
$pdf->mon_fichier="noteDeFrais.pdf";

// Création d'une page
$pdf->AddPage();


// Titre de page
$pdf->SetFont('Times', 'B', 16);
$pdf->SetTextColor(0, 0, 0); // Bleu  #0033FF
$pdf->SetX(40);
$pdf->SetFillColor(144,238,144);
$pdf->Cell(50, 10, utf8_decode("Note de frais des bénévoles"), 0, 0, 'C');
$pdf->SetX(150);
$pdf->Cell(50, 10, utf8_decode("Année civile ".$per->get_annee_per()), 0,1,"C", true);
$pdf->Ln(2);

$pdf->SetFont('Times', '', 10);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetX(20);
$pdf->Cell(20, 10, utf8_decode("Je soussigné(e)"), 0,1,"C", false);
$pdf->Cell(195, 8, utf8_decode($user->get_prenom_util()." ".$user->get_nom_util()), 0,1,"C",true);
$pdf->SetX(20);
$pdf->Cell(20, 10, utf8_decode("demeurant"), 0,1,"C",false);
$pdf->Cell(195, 8, utf8_decode($adh->get_adr1_adh()." ".$adh->get_adr2_adh()." ".$adh->get_adr3_adh()), 0,1,"C",true);
$pdf->SetX(20);
$pdf->Cell(120, 10, utf8_decode("certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association"), 0,1,"C",false);
$pdf->Cell(195, 8, utf8_decode($club->get_lib_club()), 0,1,"C",true);
$pdf->Cell(195, 8, utf8_decode($club->get_adr1_club()." ".$club->get_adr2_club()." ".$club->get_adr3_club()), 0,1,"C",true);
$pdf->SetX(20);
$pdf->Cell(20, 10, utf8_decode("en tant que don."), 0,1,"C",false);
$pdf->Ln(2);



$pdf->Ln(2);
$pdf->SetX(20);
$pdf->Cell(20, 5, utf8_decode("Frais de déplacement"), 0,0,"C",false);
$pdf->SetX(150);
$pdf->Cell(20, 5, utf8_decode("Tarif kilométrique appliqué pour le remboursement : ".$per->get_forfait_km_per()), 0,1,"C",false);


// Entête
$pdf->SetFont('', 'B',8);
$pdf->SetX(5);

$pdf->Cell(20, 10, utf8_decode("Date jj/mm/aaaa"), 1,0,"C",true);
$pdf->Cell(35, 10, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(30, 10, utf8_decode("Trajet"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Kms parcourus"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Total frais Kms"), 1,0,"C",true);
$pdf->Cell(18, 10, utf8_decode("Péages"), 1,0,"C",true);
$pdf->Cell(18, 10, utf8_decode("Repas"), 1,0,"C",true);
$pdf->Cell(18, 10, utf8_decode("Hébergement"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Total"), 1,1,"C",true);
// Contenu
$fill=false;  // panachage pour la couleur du fond
$pdf->SetFillColor(224,235,255);  // bleu clair
$total = 0;
foreach ($ldfs as $ldf) {
    $pdf->SetX(5);
    $pdf->Cell(20, 10, utf8_decode($ldf->get_date_ldf()),1,0,"C");
    $pdf->Cell(35, 10, utf8_decode('Ca marche pas'),1,0,"C");
    //$pdf->Cell(35, 10, utf8_decode($motifDAO->get_lib_mdf($ldf->get_id_mdf())),1,0,"C");
    $pdf->Cell(30, 10, utf8_decode($ldf->get_lib_trajet_ldf()),1,0,"C");
    $pdf->Cell(20, 10, utf8_decode($ldf->get_nb_km_ldf()),1,0,"C");
    $pdf->Cell(20, 10, utf8_decode($ldf->get_total_km_ldf()),1,0,"C");
    $pdf->Cell(18, 10, utf8_decode($ldf->get_cout_peage_ldf()),1,0,"C");
    $pdf->Cell(18, 10, utf8_decode($ldf->get_cout_repas_ldf()),1,0,"C");
    $pdf->Cell(18, 10, utf8_decode($ldf->get_cout_hebergement_ldf()),1,0,"C");
    $pdf->Cell(20, 10, utf8_decode($ldf->get_total_ldf().EURO),1, 1,"C", true);
    $total = $total + $ldf->get_total_ldf();
}
$pdf->SetX(5);
$pdf->Cell(179, 10, utf8_decode("Montant total des frais de déplacements"), 1,0,"C",false);
$pdf->Cell(20, 10, utf8_decode($total.EURO), 1,1,"C",true);
$pdf->Ln(2);


$pdf->SetFillColor(144,238,144);
$pdf->SetX(4);
$pdf->Cell(80, 10, utf8_decode("Je suis licencié sous le n° de licence suivant :"), 0,1,"C");
$pdf->Cell(195, 8, utf8_decode("Licence n° ".$adh->get_lic_adh()), 0,1,"C",true);
$pdf->SetX(5);
$pdf->Ln(1);
$pdf->Cell(40, 8, utf8_decode("Montant total des dons"), 0,0,"C");
$pdf->SetFillColor(224,235,255);  // bleu clair
$pdf->SetX(125);
$pdf->Cell(80, 8, utf8_decode($total.EURO), 0,1,"C",true);

$pdf->SetFont('Times', 'I', 7);
$pdf->SetX(65);
$pdf->Cell(80, 10, utf8_decode("Pour bénificier du reçu de dons, cette note de frais doit être accompagnée de tous les justificatifs correspondants."), 0,1,"C");
$pdf->SetFont('Times', '', 10);
$pdf->SetFillColor(144,238,144);
$pdf->SetX(65);
$pdf->Cell(20, 10, utf8_decode("A"), 0,0,"C");
$pdf->Cell(50, 10, utf8_decode("Toulouse"), 0,0,"C", true);
$pdf->Cell(20, 10, utf8_decode("Le"), 0,0,"C");
$pdf->Cell(50, 10, utf8_decode($date), 0,1,"C", true);
$pdf->Ln(2);
$pdf->SetX(65);
$pdf->Cell(50, 20, utf8_decode("Signature du bénévole :"), 0,0,"C", false);
$pdf->Cell(80, 20, utf8_decode($user->get_prenom_util()." ".$user->get_nom_util()), 0,1,"C", true);
$pdf->Ln(2);

$pdf->SetFillColor(205,92,92);
$pdf->Cell(100, 10, utf8_decode("Partie réservée à l'association"), 0,1,"C", true);
$pdf->Cell(50, 10, utf8_decode("N° d'ordre du reçu : "), 0,0,"L", true); // A compléter
$pdf->Cell(50, 10, utf8_decode($per->get_annee_per()."-3"), 0,1,"L", true); // A compléter
$pdf->Cell(100, 10, utf8_decode("Remis le : "), 0,1,"L", true);
$pdf->Cell(100, 10, utf8_decode("Signature du trésorier :"), 0,1,"L", true);


// Génération du document PDF
$pdf->Output('F','../outfiles/'.$pdf->mon_fichier);
header('Location: ../outfiles/'.$pdf->mon_fichier);

//$pdf->Output('D', $user->get_nom_util()."-".$per->get_annee_per()."-".$pdf->mon_fichier);
//header('Location: index.php');
?>