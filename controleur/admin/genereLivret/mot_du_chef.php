<?php
/**
 * @param MYPDF $pdf
 * @param $text
 */
function chef(MYPDF $pdf, $html)
{
    $pdf->AddPage();
    $pdf->Bookmark('Mot du Chef de département', 0, 0, '', 'B', array(0, 0, 0));
    $pdf->Cell(0, 10, 'Mot du Chef de département ', 0, 1, 'L');
    $pdf->Ln();
    $pdf->Cell(0, 15, $html, 0, false, 'C', 0, '', 0, false, 'M', 'M');

}
