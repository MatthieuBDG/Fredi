<?php
/**
 * Classe héritant de fpdf
 * On s'en sert pour pouvoir ajouter une entête et un bas de page
 * @author jef
 */
class Mon_pdf extends FPDF {

  var $mon_fichier="???";

  function Header() {
    // Formation
    $this->SetFont('Arial', '', 10); // Police Arial 10
    $this->Cell(50,8,'Fredi','B',0,'L');
    // Titre
    $this->SetFont('Arial', 'B', 10); // Police Arial gras 10
    // $this->Cell(50,8,'po27c','B',0,'C');  // Portrait
    $this->Cell(177,8,'Fredi','B',0,'C');  // Paysage
    // Date du jour
    $this->SetFont('Arial', '', 10); // Police Arial 10
    $this->Cell(50,8,date("d/m/Y"),'B',0,'R');
    // Saut de ligne
    $this->Ln(15);
  }

  function Footer() {
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);

    // Copyright
    $this->SetFont('Arial', '', 10); // Police Arial gras 10
    $this->Cell(50,8,'Institut Limayrac - Fredi','T',0,'L');
    // nom du fichier
    $this->SetFont('Arial', '', 10); // Police Arial 10
    // $this->Cell(50,8,$this->mon_fichier,'T',0,'C');  // Portrait
    $this->Cell(177,8,$this->mon_fichier,'T',0,'C');  // Paysage
    // Numéro de page
    $this->SetFont('Arial', '', 10);  // Police Arial italique 10
    $this->Cell(50, 8, 'Page ' . $this->PageNo() . '/{nb}', 'T', 0, 'R');
  }

}