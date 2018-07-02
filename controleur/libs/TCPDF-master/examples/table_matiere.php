<?php
/**
 * @param MYPDF $pdf
 * @param array $matiere
 */
function table_matiere(MYPDF $pdf)
{
    // set font
    $pdf->SetFont('times', 'B', 20);

// add a page
    $pdf->AddPage();

// set a bookmark for the current position
    $pdf->Bookmark('Sigles et abréviations', 0, 0, '', 'B', array(0, 64, 128));

// print a line using Cell()
    $pdf->Cell(0, 10, 'Sigles et abréviations', 0, 1, 'L');

// Create a fixed link to the first page using the * character
    $index_link = $pdf->AddLink();

    $pdf->SetLink($index_link, 0, '*1');
//  $pdf->Cell(0, 10, 'Link to INDEX', 0, 1, 'R', false, $index_link);
/*
    $pdf->AddPage();
    $pdf->Bookmark('Paragraph 1.1', 1, 0, '', '', array(128, 0, 0));
    $pdf->Cell(0, 10, 'Paragraph 1.1', 0, 1, 'L');
*/
    $pdf->AddPage();
    $pdf->Bookmark('Équipe pédagogique', 0, 0, '', 'B', array(0, 64, 128));
    $pdf->Cell(0, 10, 'Équipe pédagogique', 0, 1, 'L');

    $pdf->AddPage();
    $pdf->Bookmark('Mot du Chef de département', 0, 0, '', 'B', array(0, 64, 128));
    $pdf->Cell(0, 10, 'Mot du Chef de département ', 0, 1, 'L');

    $pdf->AddPage();
    $pdf->Bookmark('Extraits du réglement intérieur de l\'ESP', 0, 0, '', 'B', array(0, 64, 128));
    $pdf->Cell(0, 10, 'Extraits du réglement intérieur de l\'ESP', 0, 1, 'L');

    $pdf->AddPage();
    $pdf->Bookmark('Présentation de la formation', 0, 0, '', 'B', array(0, 64, 128));
    $pdf->Cell(0, 10, 'Présentation de la formation', 0, 1, 'L');

    $pdf->AddPage();
    $pdf->Bookmark('Extraits de l\'arrêté organisant la formation', 1, 0, '', '', array(128,0,0));
    $pdf->Cell(0, 10, 'Extraits de l\'arrêté organisant la formation', 0, 1, 'L');

    $pdf->AddPage();
    $pdf->Bookmark('Les différents semestres', 1, 0, '', '', array(128,0,0));
    $pdf->Cell(0, 10, 'Les différents semestres', 0, 1, 'L');

    $pdf->AddPage();
    $pdf->Bookmark('Autres informations utiles', 0, 0, '', 'B', array(0, 64, 128));
    $pdf->Cell(0, 10, 'Autres informations utiles', 0, 1, 'L');

// fixed link to the first page using the * character
    $html = '<a href="#*1" style="color:#8bff84;">Retour vers la table des matières</a>';
    $pdf->writeHTML($html, true, false, true, false, '');

// add a new page for TOC
    $pdf->addTOCPage();

// write the TOC title
    $pdf->SetFont('times', 'B', 16);
    $pdf->MultiCell(0, 0, 'Table Of Content', 0, 'C', 0, 1, '', '', true, 0);
    $pdf->Ln();

    $pdf->SetFont('dejavusans', '', 12);

// add a simple Table Of Content at first page
// (check the example n. 59 for the HTML version)
    $pdf->addTOC(1, 'courier', '.', 'Table des matières', 'B', array(128, 0, 0));

// end of TOC page
    $pdf->endTOCPage();
}
