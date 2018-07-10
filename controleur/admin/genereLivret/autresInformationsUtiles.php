<?php
    function printOtherInfos($pdf,$infosUtiles){
    //Affichages des informations utiles
    $pdf->setPrintFooter(true);
    $pdf->setPrintHeader(true);
    $pdf->AddPage();
    $pdf->Bookmark('Informations utiles', 2, 0, '', '', array(128, 0, 0));
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('helvetica', '', 17);
    $pdf->SetXY(7,25);
    $pdf->Cell(52, 0,"Informations utiles ", 0, false, 'L', 1, '', 0, false, 'M', 'M');
    $pdf->SetXY(7,35);
    preHTML($pdf);
    $pdf->writeHTML($infosUtiles,true,0,true,0);
}
?>
