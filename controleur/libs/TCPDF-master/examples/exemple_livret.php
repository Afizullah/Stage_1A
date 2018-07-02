<?php
// Include the main TCPDF library (search for installation path).
require_once 'tcpdf_include.php';
require_once 'header_footer.php';
require_once 'page_de_garde.php';
require_once 'table_matiere.php';
require_once 'sigle.php';
require_once 'presentation_equipe.php';
require_once 'mot_du_chef.php';
require_once 'formation.php';
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dream Team');
$pdf->SetTitle('Livret généré');
$pdf->SetSubject('Livret formation');
$pdf->SetKeywords('PDF');

// set default header data
//$pdf->SetHeaderData('../images/logo_esp.jpg', 10, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once dirname(__FILE__) . '/lang/eng.php';
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

//page de garde
page_de_garde($pdf, "2017-2018", 'Génie Informatique');

// set font
$pdf->SetFont('times', 'B', 20);

$pdf->AddPage();
$pdf->Bookmark('Sigles et abréviations', 0, 0, '', 'B', array(0, 64, 128));
$pdf->Cell(0, 10, 'Sigles et abréviations', 0, 1, 'L');

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

// add a new page for TOC
$pdf->addTOCPage();

// write the TOC title
$pdf->SetFont('times', 'B', 16);
$pdf->MultiCell(0, 0, 'Table des matières', 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();

$pdf->SetFont('dejavusans', '', 12);

// add a simple Table Of Content at first page
$pdf->addTOC(2, 'courier', '.', 'Table des matières', 'B', array(128, 0, 0));

// end of TOC page
$pdf->endTOCPage();

//sigle et abréviations
//équipe pédagogique
//mot du chef de département
//réglement intérieur
//présentation de la formation
//information utile

$pdf->Output('example.pdf', 'I');
