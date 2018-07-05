<?php
/**
 * @param MYPDF $pdf
 * @param $html
 * génére une page contenant la définition des sigles
 */
require_once 'fonctions_utiles.php';

function sigle(MYPDF $pdf, $html)
{
    $pdf->AddPage();
    $pdf->Bookmark('Sigles et abréviations', 0, 0, '', 'B', array(0, 0, 0));
    titre1($pdf,'Sigles et abréviations');
    $pdf->SetY($pdf->GetY()+5);
    $pdf->writeHTML($html);
}
