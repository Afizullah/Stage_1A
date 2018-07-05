<?php
/**
 * Created by PhpStorm.
 * User: Afiz
 * Date: 02/07/2018
 * Time: 09:34
 */
function page_couverture(TCPDF $pdf, string $tel, string $departement)
{
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();

    $image_file = K_PATH_IMAGES . 'fondc.jpg';
    $pdf->Image($image_file, 0, 15, '','', '', false, 'B', false, 300, 'C', false, false, 0, false, false, false);

    $pdf->SetTextColor(255,255,255);
    // departement
    $pdf->SetFont('helvetica', 'B', 15);
    $pdf->SetXY(0,238);
    $pdf->Cell(0, 0, 'DEPARTEMENT ', 0, 1, 'R', 0, '', 0);
    $pdf->SetXY(0,243);
    $pdf->Cell(0, 0,$departement." ", 0, 1, 'R', 0, '', 0);
    // coordonnées
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetXY(0,251);
    $pdf->Cell(0, 0,"BP: 15915—Tel: ".$tel." ", 0, 1, 'R', 0, '', 0);
}