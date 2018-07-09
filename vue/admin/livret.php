<?php

//parce que la table des matières est au début du document
$pdf->Set_Header(false,'');
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);	
// add a new page for TOC
$pdf->addTOCPage();
$pdf->Set_Header(true,'Table des matières');

// write the TOC title
$pdf->SetTextColor(94,181,77);
$pdf->SetFont('helvetica','', 20);
$pdf->MultiCell(0, 0, 'TABLE DES MATIERES', 0, 'L', 0, 1, '', '', true, 0);
$pdf->Ln();

$pdf->SetFont('dejavusansextralight', '', 12);

$bookmark_templates = array();
$bookmark_templates[0] = '<table border="0" cellpadding="0" cellspacing="0" style="background-color:#ffffff"><tr>
<td width="155mm" height="8mm"><span style="font-family:dejavusansextralight;font-weight:bold;font-size:12pt;color:black;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:dejavusansextralight;font-weight:bold;font-size:12pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
$bookmark_templates[1] = '<table border="0" cellpadding="0" cellspacing="0" style="background-color: #5eb54d;"><tr>
<td width="155mm" height="6mm"><span style="font-family:dejavusansextralight;font-weight:bold;font-size:13pt;color:#ffffff;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:dejavusansextralight;font-weight:bold;font-size:12pt;color:#ffffff;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
$bookmark_templates[2] = '<table border="0" cellpadding="0" cellspacing="0"><tr>
<td width="10mm" height="6mm">&nbsp;</td><td width="145mm"><span style="font-family:dejavusansextralight;font-size:10pt;color:#666666;"><i>#TOC_DESCRIPTION#</i></span></td><td width="25mm"><span style="font-family:dejavusansextralight;font-weight:bold;font-size:12pt;color:#666666;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
// add a simple Table Of Content at first page
$pdf->addHTMLTOC(2, 'Table des matières', $bookmark_templates, true, 'B', array(128,0,0));

// end of TOC page
$pdf->endTOCPage();

ob_end_clean();
$pdf->Output('example.pdf', 'I');
