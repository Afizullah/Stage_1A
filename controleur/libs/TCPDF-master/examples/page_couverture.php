<?php
/**
 * Created by PhpStorm.
 * User: Afiz
 * Date: 02/07/2018
 * Time: 09:34
 */
function page_couverture(TCPDF $pdf, string $year, string $departement)
{
// set font
    $pdf->SetFont('times', 'BI', 14);
// set le footer
    //   $pdf->setFooterData();
// Start First Page Group
    $pdf->startPageGroup();
// add a page
    $pdf->AddPage();
// inscris l'année scolaire
    $pdf->SetXY(100, 50);
    $pdf->writeHTML($year);
// mention
    $pdf->SetXY(100, 80);
    $pdf->Cell(10, 15, "Au revoir", 0, false, 'C', 0, '', 0, false, 'M', 'M');
// logo
    $image_file = K_PATH_IMAGES . 'logo_esp.jpg';
    $pdf->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', true, true, 0, false, false, true);


}