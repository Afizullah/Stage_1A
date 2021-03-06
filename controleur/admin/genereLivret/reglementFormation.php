<?php
function printReglementFormation($pdf, $formationNomComplet, $formationCode, $reglementFormation)
{
    $pdf->SetFillColor(94, 181, 77);
    $pdf->Set_Header(false);
    $pdf->AddPage();
    $pdf->Bookmark($formationNomComplet . '(' . $formationCode . ')', 1, 0, '', 'B', array(0, 0, 0));
    $pdf->Set_Header(true, $formationNomComplet . '(' . $formationCode . ')');

    //Affichage réglement de la fromation
    //affichage du titre nom de la formation
    $pdf->SetTextColor(94, 181, 77);
    $pdf->SetFont('helvetica', '', 20);
    $pdf->SetXY(13, 25);
    //$pdf->SetMargins(PDF_MARGIN_LEFT+15, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT+15);
    $pdf->Write('', $formationNomComplet, '', 0, 'C');
    //titre dans la partie concernée
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('helvetica', '', 17);
    $pdf->SetXY(13, $pdf->getY() + 15);
    $pdf->Cell(120, 0, "Extraits de l'arrêté organisant la formation ", 0, false, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->Bookmark('Extraits de l\'arrêté organisant la formation', 2, 0, '', '', array(0, 0, 0));  
    //extraits de l'arreté organisant la formation
    $pdf->SetX(13);
    $pdf->setY($pdf->getY()+10);
    preHTML($pdf); 
    $pdf->writeHTML($reglementFormation);

}

?>
