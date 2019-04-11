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
        $this->SetTextColor(30,50,10);
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

    // Tableau simple
    function BasicTable($header, $data)
    {
        // En-tête

        foreach($header as $col) {
            $col = iconv('utf-8', 'cp1252', $col);
            $this->Cell(70, 7, $col, 1);
        }
        $this->Ln();

        // Données

        foreach($data as $row) {
            foreach($row as $col) {
                $col = iconv('utf-8', 'cp1252', $col);
                $this->Cell(70, 7, $col, 1);
                $this->SetFont('Arial', '', 11);
            }
            $this->Ln();
        }

    }

}
