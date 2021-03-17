<?php
session_start();
/**
 * Liste des pays en PDF
 */
require_once "../init.php";
require_once "../fpdf/fpdf.php";

$id = isset($_GET['id']) ? $_GET['id']: 0;
$annee = isset($_GET['per']) ? $_GET['per']: 0;

$DAO= NEW LigueDAO;
$rows=$DAO->cumulFrais($id, $annee);
$ligue=$DAO->find($id);

define('EURO'," ".utf8_encode(chr(128))); // créé la constante pour le symbole ascii euro (sinon probleme d'affichage)



// Instanciation de l'objet dérivé
$pdf = new Mon_pdf();   // Paysage

// Metadonnées
$pdf->SetTitle('cumulfrais', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('cumulfrais', true);
$pdf->mon_fichier="cumulFrais.pdf";

// Création d'une page
$pdf->AddPage();

// Aller chercher la ligue avec finddao

// Titre de page
$pdf->SetFont('Times', 'B', 16);
$pdf->SetTextColor(0, 0, 0); // Bleu  #0033FF
$pdf->SetX(0);
$pdf->SetFillColor(144,238,144);
$pdf->Cell(200, 10, utf8_decode("Cumul de frais de la ligue de ".$ligue->get_lib_ligue()." pour l'annee ".$annee), 0, 1, 'C');

//$pdf->Cell(50, 10, utf8_decode("Année civile ".$per->get_annee_per()), 0,1,"C", true);
$pdf->Ln(7);
/*
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

*/
// Entête
$pdf->SetFont('', 'B',8);
$pdf->SetX(25);

$pdf->Cell(50, 10, utf8_decode("Club"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Motif"), 1,0,"C",true);
$pdf->Cell(50, 10, utf8_decode("Cumul"), 1,1,"C",true);

// Contenu
$fill=false;  // panachage pour la couleur du fond
$pdf->SetFillColor(224,235,255);  // bleu clair
$total = 0;
$club = '';
foreach ($rows as $row) { // compte le nombre de ligne par club
    if (isset($nbLignes[$row['lib_club']])){
        $nbLignes[$row['lib_club']] = $nbLignes[$row['lib_club']]+1; //si la variable existe, on incrémente
    }
    else{
        $nbLignes[$row['lib_club']] = 1; //sinon on l'initie à 1
    }
}

foreach ($rows as $row) {
    $pdf->SetX(25);

    if ($club != $row['lib_club']) {
        $pdf->Cell(50, 10*$nbLignes[$row['lib_club']], utf8_decode($row['lib_club']), 1, 0, "C"); //pour la première cellule, la hauteur dépend du nombre de lignes
        $club = $row['lib_club'];
    }
    else {
        $pdf->SetX(75);
    }
    $pdf->Cell(50, 10, utf8_decode($row['lib_mdf']),1,0,"C");
    $pdf->Cell(50, 10, utf8_decode($row['total'].EURO),1,1,"C");
    $total = $total + $row['total'];
}
$pdf->SetX(25);
$pdf->Cell(100, 10, utf8_decode("Montant total des frais de déplacements"), 1,0,"C",false);
$pdf->Cell(50, 10, utf8_decode($total.EURO), 1,1,"C",true);
$pdf->Ln(2);

/*
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
$pdf->Cell(50, 10, utf8_decode(""), 0,0,"C", true);
$pdf->Cell(20, 10, utf8_decode("Le"), 0,0,"C");
$pdf->Cell(50, 10, utf8_decode(""), 0,1,"C", true);
$pdf->Ln(2);
$pdf->SetX(65);
$pdf->Cell(50, 20, utf8_decode("Signature du bénévole :"), 0,0,"C", false);
$pdf->Cell(80, 20, utf8_decode(""), 0,1,"C", true);
$pdf->Ln(2);

$pdf->SetFillColor(205,92,92);
$pdf->Cell(100, 10, utf8_decode("Partie réservée à l'association"), 0,1,"C", true);
$pdf->Cell(50, 10, utf8_decode("N° d'ordre du reçu : "), 0,0,"L", true); // A compléter
$pdf->Cell(50, 10, utf8_decode($per->get_annee_per()."-A CHANGER"), 0,1,"L", true); // A compléter
$pdf->Cell(100, 10, utf8_decode("Remis le : "), 0,1,"L", true);
$pdf->Cell(100, 10, utf8_decode("Signature du trésorier :"), 0,1,"L", true);

*/
// Génération du document PDF
$pdf->Output('F','../outfiles/'.$pdf->mon_fichier);
header('Location: ../outfiles/'.$pdf->mon_fichier);
//header('Location: index.php');