<?php
/**
 * @param MYPDF $pdf
 * @param $titre
 * @param $html
 * génére une page contenant la définition des sigles
 */
function printInvariant(MYPDF $pdf, $titre,$html)
{
	$pdf->Set_Header(false);
    $pdf->AddPage();
    $pdf->Set_Header(true,$titre);
    $pdf->Bookmark($titre, 0, 0, '', 'B', array(0, 0, 0));
    $pdf->SetTextColor(94,181,77);
    $pdf->SetFont('helvetica', '', 20);
    $pdf->Cell(0, 10, $titre, 0, 1, 'L');
    $pdf->SetY($pdf->GetY()+5);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('times', '', 12);
    $pdf->writeHTML($html);
}
