<?php
function page_de_garde(TCPDF $pdf, $year, $departement)
{
// set font
    $pdf->SetFont('times', 'BI', 35);
// add a page
    $pdf->AddPage();
// logo
    $image_file = K_PATH_IMAGES.'logo_esp.jpg';
    $pdf->Image($image_file, 'C', 8, '', '', 'JPG', false, 'C', false, 300, 'C', false, false, 0, false, false, false);
// mention
    $pdf->SetXY(100, 175);
    $pdf->Cell(10, 35, "Livret de l'étudiant", 0, false, 'C', 0, '', 0, false, 'M', 'M');
// inscris l'année scolaire
    $pdf->SetXY(100,200);
    $pdf->Cell(20, 30, $year, 0, false, 'C', 0, '', 0, false, 'M', 'M');
// departement
    $pdf->SetXY(0,250);
    $pdf->Cell(0, 0, 'Département '.$departement, 0, 1, 'C', 0, '', 0);
    // set font
    $pdf->SetFont('times', 'BI', 14);

}
