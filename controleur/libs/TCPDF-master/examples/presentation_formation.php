<?php 
require_once 'fonctions_utiles.php';
require_once 'tableau_livret.php';
require_once 'header_footer.php';

function presentation_formation($pdf,$formations,$annonce_elements){
	$pdf->Set_Header(false);
	$pdf->AddPage();
    $pdf->Bookmark('Présentation des formations ', 0, 0, '', 'B', array(0, 0, 0));
    titre1($pdf,"Présentation des formations");
	$pdf->setXY(10,$pdf->getY()+7);
	preHTML($pdf,true);
	$pdf->writeHTML("<p>Dans la suite de ce livret sont présentées les formations suivantes :</p>", true, 0, true, 0);
	$pdf->setXY(8,$pdf->getY()+3);
	preHTML($pdf,false);
	$pdf->writeHTML(tab_formation($formations), true, 0, true, 0);
	$pdf->setXY(13,$pdf->getY()+5);
	preHTML($pdf,true);
	$pdf->writeHTML($annonce_elements, true, 0, true, 0);
}