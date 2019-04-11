<?php
require('fpdf.php');

class PDF extends FPDF
{

    public $titre;

    // Header
    function Header() {
        // Logo
        $this->Image('images/algobreizh.png',8,6,50);
        $this->SetFont('Arial','',50);
        $this->SetTextColor(50,255,150);
        $this->Text(90,25,'Algobreizh');
        // Saut de ligne
        $this->Ln(20);
    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Adresse
        $this->Cell(196,5,'AlgoBreizh - 29810 LAMPAUL-PLOUARZEL - 02.98.97.96.95',0,0,'C');
    }
    /*
    function Header()
    {
        // Logo
        $this->Image('img/logo.png',10,6,30);
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(50,15,$this->titre,1,0,'C');
        // Saut de ligne
        $this->Ln(20);
    }

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    */

    // Tableau simple
    function BasicTable($header, $data)
    {
        // En-tête

        foreach($header as $col) {
            $col = iconv('utf-8', 'cp1252', $col);
            $this->Cell(60, 7, $col, 1);
        }
        $this->Ln();

        // Données

        foreach($data as $row) {
            foreach($row as $col) {
                $col = iconv('utf-8', 'cp1252', $col);
                $this->Cell(60, 7, $col, 1);
            }
            $this->Ln();
        }

    }

}
