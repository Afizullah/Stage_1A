<?php
function equipe(MYPDF $pdf,$prenoms,$noms,$specialites,$fonctions,$phrase_presentation)
{
   	$pdf->Set_Header(false);
	$pdf->AddPage();
	$pdf->Bookmark("Equipe pédagogique", 0, 0, '', 'B', array(0, 64, 128));
	$pdf->Set_Header(true,"Equipe pédagogique");

	$pdf->SetTextColor(94,181,77);
    $pdf->SetFont('dejavusans', '', 25);
    $pdf->SetXY(7,25);
    $pdf->Cell(0, 0,"EQUIPE PEDAGOGIQUE", 0, false, 'L', 0, '', 0, false, 'M', 'M');

    $pdf->SetXY(7,40);
    preHTML($pdf);
    $pdf->writeHTML($phrase_presentation, true, 0, true, 0);


    $html=tab_enseignants($prenoms,$noms,$specialites,$fonctions);
	$pdf->SetXY(7,$pdf->getY()+5);
	preHTML($pdf);
    $pdf->writeHTML($html, true, 0, true, 0);
	}
