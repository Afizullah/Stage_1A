<?php

function formation(MYPDF $pdf, $semestre, $ue, $nom, $code, $formation, $coeff, $cm, $td, $tp, $tpe, $obj, $prerequis, $contenu, $eval, $credits, $phrase_presentation)
{
    //Affichage des détails de la formations
    //couleur du bookmark
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFillColor(94, 181, 77);
    $pdf->AddPage();
    $pdf->Bookmark('Les différents semestres', 2, 0, '', '', array(0, 0, 0));
    $pdf->SetFillColor(94, 181, 77);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('helvetica', '', 17);
    $pdf->SetXY(7, 25);
    $pdf->Cell(75, 0, "Les différents semestres ", 0, false, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->SetXY(7, 35);
    preHTML($pdf);
    $pdf->writeHTML($phrase_presentation, true, 0, true, 0);
    $pdf->SetXY(7, $pdf->getY() + 7);
    $tab_matiere = tab_matieres($semestre, $ue, $nom, $coeff, $cm, $td, $tp, $tpe, $credits);
    $tab_detail_matiere = tab_details_matiere($semestre, $ue, $nom, $code, $formation, $coeff, $cm, $td, $tp, $tpe, $obj, $prerequis, $contenu, $eval, $credits);
    preHTML($pdf, false);
    $pdf->writeHTML($tab_matiere, true, 0, true, 0);
    $pdf->AddPage();
    preHTML($pdf, false);
    $pdf->writeHTML($tab_detail_matiere, true, 0, true, 0);
}
