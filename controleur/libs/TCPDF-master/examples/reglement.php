<?php
function reglement(MYPDF $pdf, $html)
{
    $pdf->AddPage();
    $pdf->Bookmark('Extraits du réglement intérieur de l\'ESP', 0, 0, '', 'B', array(0, 64, 128));
    $pdf->Cell(0, 10, 'Extraits du réglement intérieur de l\'ESP', 0, 1, 'L');
    $pdf->Ln();
    $pdf->Cell(0, 15, $html, 0, false, 'C', 0, '', 0, false, 'M', 'M');

}
