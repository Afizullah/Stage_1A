<?php

function preHTML(MYPDF $pdf,$type='true'){
	if ($type){
		$pdf->SetFont('dejavusansextralight','',13);
	}
	else {
		$pdf->SetFont('helvetica','',13);
	}
	$pdf->SetTextColor(0,0,0);
}

function titre1(MYPDF $pdf,$titre){
    $police = array();
    $police[1] = $pdf->getFontFamily();
    $police[2] = $pdf->getFontStyle();
	$police[3] = $pdf->getFontSizePt();
    $pdf->SetTextColor(94,181,77);
    $pdf->SetFont('dejavusansextralight', 'B', 25);
    $pdf->Cell(0, 10, $titre, 0, 1, 'C',0,'',0,false);
    //$pdf->Cell(0, 0,$titre, 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $pdf->SetFont($police[1], $police[2], $police[3]);
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln();
}
function texte1(MYPDF $pdf, $html){

}


