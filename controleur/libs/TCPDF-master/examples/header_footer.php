<?php
require_once 'tcpdf_include.php';

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    public $suite = false;

    //Page header
    public function Header()
    {
        if (!$this->suite) {
            // Logo
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $this->Image('images/header_1.jpg', 0, 10, 0, 8, 'JPEG', '', 'N', false, 300, 'L', false, false, 0, true, false, false, '');
//          $this->SetXY(35, 5);
//      $this->Write(0, 'Test', $link='', $fill=false, $align='R', $ln=true, $stretch=0, $firstline=true, $firstblock=false, $maxh=0, $wadj=0, $margin='');
            // Title
            //$this->Cell(0, 15, 'Présentation de l\'ESP', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 15);
        } else {
            // Logo
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $this->Image('images/header_2.jpg', 0, 10, 0, 7, 'JPEG', '', 'N', false, 300, 'R', false, false, 0, true, false, false, '');
            $this->SetXY(30, 5);
            $this->Write(0, 'Présentation de la formation', $link = '', $fill = false, $align = 'R', $ln = true, $stretch = 0, $firstline = true, $firstblock = false, $maxh = 0, $wadj = 0, $margin = '');
            // Title
            //$this->Cell(0, 15, 'Présentation de l\'ESP', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 15);
        }
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', 'I', 10);
        $this->SetFillColor(255, 255, 255);
        // Page number
        $this->Image('images/footer.jpg', 177, $this->GetY(), 0, 12, 'JPEG', '', 'M', false, 300, '', false, false, 0, true, false, false, '');
        $this->SetY($this->GetY()-5);
        $this->SetX(-17);
        //$this->Write(5, $this->getAliasNumPage(),false,false,'R');
        $this->Cell(0,10,$this->getAliasNumPage(),0,0,'R','','','','','','');
    }
}
