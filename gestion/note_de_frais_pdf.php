<?php
/**
 * Liste des pays en PDF
 */
require_once "../init.php";
require_once "../fpdf/fpdf.php";

// Crée le tableau d'objets métier "pays"
$dao = new Ligne_de_fraisDAO();
$ligne_de_frais = $dao->findAll();

// Instanciation de l'objet dérivé
$pdf = new Mon_pdf("L");   // Paysage

// Metadonnées
$pdf->SetTitle('Fredi', true);
$pdf->SetAuthor('Fredi', true);
$pdf->SetSubject('Liste des pays', true);
$pdf->mon_fichier="note_de_frais.pdf";

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Times', '', 24);
$pdf->SetTextColor(0, 51, 255); // Bleu  #0033FF
$pdf->Cell(0, 20, utf8_decode("Liste des pays"), 0, 1, 'C');
$pdf->Ln(8);

// Boucle des lignes
$pdf->SetFont('Times', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(20);
$pdf->SetFillColor(211,211,211);
$pdf->Cell(20, 10, utf8_decode("ID"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom (FR)"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Code"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Alpha2"), 1,0,"C",true);
$pdf->Cell(20, 10, utf8_decode("Alpha3"), 1,0,"C",true);
$pdf->Cell(80, 10, utf8_decode("Nom (EN)"), 1,1,"C",true);
// Contenu
$fill=false;  // panachage pour la couleur du fond
$pdf->SetFillColor(224,235,255);  // bleu clair
foreach ($ligne_de_frais as $ligne_de_frais) {
    $pdf->SetFont('', '');
    $pdf->SetX(20);
    $pdf->Cell(20, 10, utf8_decode($ligne_de_frais->get_id_ldf()),1,0,"C",$fill);
    $pdf->Cell(80, 10, utf8_decode($ligne_de_frais->get_id_ldf()),1,0,"C",$fill);
    $pdf->Cell(20, 10, utf8_decode($ligne_de_frais->get_id_ldf()),1,0,"C",$fill);
    $pdf->Cell(20, 10, utf8_decode($ligne_de_frais->get_id_ldf()),1,0,"C",$fill);
    $pdf->Cell(20, 10, utf8_decode($ligne_de_frais->get_id_ldf()),1,0,"C",$fill);
    $pdf->Cell(80, 10, utf8_decode($ligne_de_frais->get_id_ldf()),1, 1,"C",$fill);
    $fill=!$fill;  // Inverse le panachage
}

// Nb de pays
$pdf->Ln(8);
//$nb = count($ligne_de_frais);
$pdf->SetFont('', '');
$pdf->SetX(20);
//$pdf->Cell(0, 5, utf8_decode($nb . ' pays'), 0, 1);

// Génération du document PDF
$pdf->Output('f','../outfiles/'.$pdf->mon_fichier);
header('Location: ../outfiles/'.$pdf->mon_fichier);
