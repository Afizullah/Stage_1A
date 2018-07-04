<?php
/**
 * @param MYPDF $pdf
 * @param $html
 * génére une page contenant la définition des sigles
 */
function sigle(MYPDF $pdf, $html)
{
    $pdf->AddPage();
    $pdf->Bookmark('Sigles et abréviations', 0, 0, '', 'B', array(0, 0, 0));
    $pdf->Cell(0, 10, 'Sigles et abréviations', 0, 1, 'L');
    $pdf->SetY($pdf->GetY()+5);
    $pdf->writeHTML($html);
}
