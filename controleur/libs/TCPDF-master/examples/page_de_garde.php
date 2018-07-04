<?php
function page_de_garde(TCPDF $pdf, $year, $departement,$tel,$mail)
{
// set font
    $pdf->SetFont('helvetica', '', 35);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
// add a page
    $pdf->AddPage();
// fond
    $image_file = K_PATH_IMAGES.'fondf.jpg';
    $pdf->Image($image_file, 0, 15, '','', '', false, 'B', false, 300, 'C', false, false, 0, false, false, false);
// logo
    $image_file = K_PATH_IMAGES.'logo_ucad.jpg';
    $pdf->Image($image_file, 161, 17, 14,'', '', false, 'B', false, 300, 'M', false, false, 0, false, false, false);
// nom de l'université
    $pdf->SetTextColor(170,170,170);
    $pdf->SetFont('dejavusansextralight', '', 10);
    $pdf->SetXY(135,33);
    $pdf->Cell(0, 0, "UNIVERSITE CHEIKH ANTA DIOP DE DAKAR", 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $pdf->SetXY(135,37);
    $pdf->Cell(0, 0, "ECOLE SUPERIEURE POLYTECHNIQUE", 0, false, 'C', 0, '', 0, false, 'M', 'M');
    $pdf->SetXY(135,41);
    $pdf->Cell(0, 0,"DEPARTEMENT GENIE INFORMATIQUE", 0, false, 'C', 0, '', 0, false, 'M', 'M');
// mention
    $pdf->SetTextColor(16,157,236);
    $pdf->SetFont('helvetica', '', 70);
    $pdf->SetXY(0, 110);
    $pdf->Cell(0, 0, "LIVRET", 0, false, 'R', 0, '', 0, false, 'M', 'M');
    $pdf->SetFont('helvetica', '', 40);
    $pdf->SetXY(0, 130);
    $pdf->Cell(0, 0, "DE L'ETUDIANT", 0, false, 'R', 0, '', 0, false, 'M', 'M');
// type de formation
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('helvetica', '', 22);
    $pdf->SetXY(0, 155);
    $pdf->Cell(0, 0, "DUT - DST - LICENCE ", 0, false, 'R', 0, '', 0, false, 'M', 'M');
// inscris l'année scolaire
    $pdf->SetTextColor(16,157,236);
    $pdf->SetFont('helvetica', '', 30);
    $pdf->SetXY(0,172);
    $pdf->Cell(0, 0, $year, 0, false, 'R', 0, '', 0, false, 'M', 'M');
// departement
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->SetXY(0,233);
    $pdf->Cell(0, 0, 'DEPARTEMENT', 0, 1, 'R', 0, '', 0);
    $pdf->SetXY(0,238);
    $pdf->Cell(0, 0,strtoupper($departement), 0, 1, 'R', 0, '', 0);
// coordonnées
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetXY(0,246);
    $pdf->Cell(0, 0,"BP: 15915—Tel: ".$tel, 0, 1, 'R', 0, '', 0);
    $pdf->SetXY(0,250);
    $pdf->Cell(0, 0,"Mail : ".$mail, 0, 1, 'R', 0, '', 0);
    // set font
    $pdf->SetFont('times', 'BI', 14);
    $pdf->setPrintHeader(true);
    $pdf->setPrintFooter(true);
}
