<?php

function getSemestre($int){
    $semestre[1] = "un";
    $semestre[2] = "deux";
    $semestre[3] = "trois";
    $semestre[4] = "quatre";
    $semestre[5] = "cinq";
    $semestre[6] = "six";
    $semestre[7] = "sept";
    $semestre[8] = "huit";
    if(isset($semestre[intval($int)])){
        return $semestre[intval($int)];
    }
    return $int;
}

function formation(MYPDF $pdf, $semestre, $ue, $nom, $code, $formation, $coeff, $cm, $td, $tp, $tpe, $obj, $prerequis, $contenu, $eval, $credits, $phrase_presentation,$codeFormation)
{
    $smstr = array();
    for ($iSem=0; $iSem < count($semestre) ; $iSem++) { 
        if(!in_array($semestre[$iSem],$smstr)){
            $smstr[]=$semestre[$iSem];
        }
    }
    $nbrSemestre = count($smstr);
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
    $phrase_presentation = '<p style="text-align:justify"><span style="font-size:13px"><span style="font-family:Georgia,serif">Le <b>'.$codeFormation.'</b> comprend '.getSemestre($nbrSemestre).' semestres qui sont présentés dans le tableau qui suit. S’ensuit une description plus détaillée de chacun d’eux.</span></span></p>';
    $pdf->writeHTML($phrase_presentation, true, 0, true, 0);
    $pdf->SetXY(7, $pdf->getY() + 7);
    $tab_matiere = tab_matieres($semestre, $ue, $nom, $coeff, $cm, $td, $tp, $tpe, $credits);
    $tab_detail_matiere = tab_details_matiere($semestre, $ue, $nom, $code, $formation, $coeff, $cm, $td, $tp, $tpe, $obj, $prerequis, $contenu, $eval, $credits);
    preHTML($pdf, false);
    $pdf->SetMargins(PDF_MARGIN_LEFT+5, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    $pdf->writeHTML($tab_matiere, true, 0, true, 0);
    $pdf->AddPage();
    preHTML($pdf, false);
    $pdf->writeHTML($tab_detail_matiere, true, 0, true, 0);
}
