<?php

//parce que la table des matières est au début du document
$pdf->Set_Header(false,'');
// add a new page for TOC
$pdf->addTOCPage();

// write the TOC title
$pdf->SetFont('times', 'B', 16);
$pdf->MultiCell(0, 0, 'Table des matières', 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();

$pdf->SetFont('dejavusansextralight', '', 12);

// add a simple Table Of Content at first page
$pdf->addTOC(2, 'courier', '', 'Table des matières', 'B', array(94, 181, 77));

// end of TOC page
$pdf->endTOCPage();

ob_end_clean();
$pdf->Output('example.pdf', 'I');
