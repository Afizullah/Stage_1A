<?php

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{
 
    private $formation = false;
    private $text_header;
    private $docname;

    public function Set_Header($formation, $text_header = '')
    {
        $this->formation = $formation;
        $this->text_header = $text_header;
    }

    public function getDocName(){
        return $this->docname;
    }

    public function setDocName($str){
        $this->docname = $str;
    }
    //Page header
    public function Header()
    {
        if (!$this->formation) {
            // Logo
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $this->Image(PATH_IMG . '/header_1.jpg', 0, 10, 0, 8, 'JPEG', '', 'N', true, 300, 'L', false, false, 0, true, false, false, '');
            //   $this->SetXY(35, 5);
            //   $this->Write(0, 'Test', $link='', $fill=false, $align='R', $ln=true, $stretch=0, $firstline=true, $firstblock=false, $maxh=0, $wadj=0, $margin='');
            // Title
            //$this->Cell(0, 15, 'Présentation de l\'ESP', 0, false, 'C', 0, '', 0, false, 'M', 'M');
            $this->SetFont('helvetica', 'B', 15);
        } else {
            // Logo
            // Set font
            $this->SetFont('helvetica', 'B', 10);
            $this->Image(PATH_IMG . '/header_2.jpg', 0, 10, 150, 0, 'JPEG', '', 'N', true, 300, 'R', false, false, 0, true, false, false, '');
            $this->SetXY(0, $this->GetY() - 4.5);
            //$this->Write(6, $this->text_header, $link = '', $fill = false, $align = 'R', $ln = true, $stretch = 0, $firstline = true, $firstblock = false, $maxh = 10, $wadj = 0);
            // Title
            $this->SetTextColor(255, 255, 255);
            $this->Cell(0, 0, $this->text_header . " ", 0, false, 'R', 0, '', 0, false, 'M', 'M');
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('helvetica', 'B', 15);
        }
    }

    // Page footer
    public function Footer()
    {
        $this->SetY(-20);
        // Set font
        $this->SetFont('helvetica', 'I', 10);
        $this->SetFillColor(255, 255, 255);
        // Page number
        $this->Image(PATH_IMG . '/footer_bis.jpg', 178, $this->GetY(), 0, 12, 'JPEG', '', 'M', false, 300, '', false, false, 0, true, false, false, '');
        $this->SetY($this->GetY() - 5);
        $this->SetX(-10);
        $this->SetTextColor(255, 255, 255);
        //$this->Write(5, $this->getAliasNumPage(),false,false,'R');
        $this->Cell(0, 10, $this->getAliasNumPage(), 0, 0, 'R', '', '', '', '', '', '');
        $this->SetTextColor(0, 0, 0);

    }
}
