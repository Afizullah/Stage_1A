<?php

function preHTML($pdf,$type='true'){
	if ($type){
		$pdf->SetFont('dejavusansextralight','',13);
	}
	else {
		$pdf->SetFont('helvetica','',13);
	}
	$pdf->SetTextColor(0,0,0);
}

function titre1($pdf,$titre){
	$pdf->SetTextColor(94,181,77);
    $pdf->SetFont('dejavusans', '', 25);
    $pdf->SetXY(10,30);
    $pdf->Cell(0, 0,$titre, 0, false, 'L', 0, '', 0, false, 'M', 'M');
}


