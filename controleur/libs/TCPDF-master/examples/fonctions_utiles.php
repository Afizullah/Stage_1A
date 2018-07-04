<?php

function preHTML($pdf,$type='true'){
	if ($type){
		$pdf->SetFont('dejavusansextralight','',13);
	}
	else {
		$pdf->SetFont('helvetica','',12);
	}
	$pdf->SetTextColor(0,0,0);
}

