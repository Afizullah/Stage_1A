<?php
require_once 'tcpdf_include.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    public $suite = false;
    //Page header
    public function Header($suite)
    {
        if (!$suite) {
            // Logo
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $this->Image('images/header_1.jpg', 0, 5, 0, 8, 'JPEG', '', 'N', false, 300, 'L', false, false, 0, true, false, false, '');
            $this->SetXY(35, 5);
//      $this->Write(0, 'Test', $link='', $fill=false, $align='R', $ln=true, $stretch=0, $firstline=true, $firstblock=false, $maxh=0, $wadj=0, $margin='');
            // Title
            //$this->Cell(0, 15, 'Présentation de l\'ESP', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 15);
        }
        else{
            // Logo
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $this->Image('images/header_1.jpg', 0, 5, 0, 8, 'JPEG', '', 'N', false, 300, 'L', false, false, 0, true, false, false, '');
            $this->SetXY(35, 5);
//      $this->Write(0, 'Test', $link='', $fill=false, $align='R', $ln=true, $stretch=0, $firstline=true, $firstblock=false, $maxh=0, $wadj=0, $margin='');
            // Title
            //$this->Cell(0, 15, 'Présentation de l\'ESP', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 15);



        }
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->SetFillColor(255, 255, 255);
        $this->MultiCell(55, 5, '[LEFT]  ', 0, 'C', 1, 0, '', '', true);
        //$this->MultiCell(55, 5, '[RIGHT] ', 1, 'R', 1, 1, '', '', true);

        $this->MultiCell(55, 5, '        ', 0, 'R', 0, 0, '', '', true);
        $this->SetFillColor(255, 255, 255);
        $this->MultiCell(55, 5, $this->getAliasNumPage(), 0, 'R', 1, 1, '', '', true);

        // Page number
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 1, '', 0, false, 'T', 'M');
    }
}
