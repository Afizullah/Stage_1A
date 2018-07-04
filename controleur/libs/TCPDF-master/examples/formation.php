<?php
require_once 'tcpdf_include.php';
require_once 'header_footer.php';
require_once 'tableau_livret.php';
require_once 'fonctions_utiles.php';


function formation(MYPDF $pdf,$semestre,$ue,$nom,$code,$formation,$coeff,$cm,$td,$tp,$tpe,$obj,$prerequis,$contenu,$eval,$credits,$reglement,$phrase_presentation,$informations_utiles)
{
	$pdf->SetFillColor(94,181,77);
	$pdf->Set_Header(false);
	$pdf->AddPage();
	$pdf->Bookmark($formation, 0, 0, '', 'B', array(0, 0, 0));
	$pdf->Set_Header(true,$formation);
	
	//Affichage réglement de la fromation
	//affichage du titre nom de la formation
   	$pdf->SetTextColor(94,181,77);
    $pdf->SetFont('helvetica', '', 25);
    $pdf->SetXY(0,25);
    $pdf->Cell(0, 0,$formation, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    //titre dans la partie concernée
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('helvetica', '', 17);
    $pdf->SetXY(7,35);	
    $pdf->Cell(120, 0,"Extraits de l'arrêté organisant la formation ",0, false, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->Bookmark('Extraits de l\'arrêté organisant la formation', 1, 0, '', '', array(0, 0, 0));
    //extraits de l'arreté organisant la formation
    $pdf->SetXY(0,50);
    preHTML($pdf);
    $pdf->writeHTML($reglement, true, 0, true, 0);

    //Affichage des détails de la formations
    //couleur du bookmark
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFillColor(94, 181, 77);
    $pdf->AddPage();
    $pdf->Bookmark('Les différents semestres', 1, 0, '', '', array(0, 0, 0));
    $pdf->SetFillColor(94, 181, 77);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('helvetica', '', 17);
    $pdf->SetXY(7,25);
    $pdf->Cell(75, 0,"Les différents semestres ", 0, false, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->SetXY(7,35);
    preHTML($pdf);
    $pdf->writeHTML($phrase_presentation, true, 0, true, 0);
    $pdf->SetXY(7,$pdf->getY()+7);
    $tab_matiere=tab_matieres($semestre,$ue,$nom,$coeff,$cm,$td,$tp,$tpe,$credits);
    $tab_detail_matiere=tab_details_matière($semestre,$ue,$nom,$code,$formation,$coeff,$cm,$td,$tp,$tpe,$obj,$prerequis,$contenu,$eval,$credits);
    preHTML($pdf,false);
    $pdf->writeHTML($tab_matiere, true, 0, true, 0);
    $pdf->AddPage();
    preHTML($pdf,false);
    $pdf->writeHTML($tab_detail_matiere,true,0,true,0);

    //Affichages des informations utiles
    $pdf->AddPage();
    $pdf->Bookmark('Informations utiles', 1, 0, '', '', array(128, 0, 0));
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('helvetica', '', 17);
    $pdf->SetXY(7,25);
    $pdf->Cell(52, 0,"Informations utiles ", 0, false, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->SetXY(7,35);
    preHTML($pdf);
    $pdf->writeHTML($informations_utiles,true,0,true,0);
}
