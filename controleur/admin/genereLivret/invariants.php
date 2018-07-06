<?php
/**
 * @param MYPDF $pdf
 * @param $titre
 * @param $html
 * génére une page contenant la définition des sigles
 */
function printInvariant(MYPDF $pdf, $titre,$html)
{
    $pdf->AddPage();
    $pdf->Bookmark($titre, 0, 0, '', 'B', array(0, 0, 0));
    $pdf->SetTextColor(16,157,236);
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Cell(0, 10, $titre, 0, 1, 'L');
    $pdf->SetY($pdf->GetY()+5);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('times', '', 12);
    $pdf->writeHTML($html);
}
