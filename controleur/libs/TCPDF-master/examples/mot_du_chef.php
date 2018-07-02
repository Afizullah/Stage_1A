<?php
/**
 * @param MYPDF $pdf
 * @param $text
 */
function chef(MYPDF $pdf, $text)
{
//    $pdf->setFooter();
    // Start First Page Group
    $pdf->AddPage();
    $pdf->startPageGroup();
// This is the first page of group 1.
    $pdf->Cell(0, 15, $text, 0, false, 'C', 0, '', 0, false, 'M', 'M');

}
