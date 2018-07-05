<?php
// Include the main TCPDF library (search for installation path).
require_once 'tcpdf_include.php';
require_once 'header_footer.php';
require_once 'page_de_garde.php';
require_once 'sigle.php';
require_once 'presentation_equipe.php';
require_once 'presentation_formation.php';
require_once 'mot_du_chef.php';
require_once 'reglement.php';
require_once 'formation.php';
require_once 'page_couverture.php';

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Dream Team');
$pdf->SetTitle('Livret généré');
$pdf->SetSubject('Livret formation');
$pdf->SetKeywords('PDF');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT+5, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT+5);
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
page_de_garde($pdf, "2017-2018",'DUT - DST - LICENCE', 'GENIE INFORMATIQUE',"(+221) 33 825 75 28)", "secretariat-dgi@esp.sn");

// set font
//$pdf->SetFont('helvetica', '', 20);
//$pdf->SetFont('times', 'BI', 14);

//Partie sigle et abréviations
sigle($pdf,'Test sigle');

//Partie équipe pédagogique
$prenoms=["prenom1","prenom2","prenom3","prenom4","prenom5"];
$noms=["nom1","nom2","nom3","nom4","nom5"];
$specialites=["specialite1","specialite2","specialite3","specialite4","specialite5"];
$fonctions=["fonction1","fonction2","fonction3","fonction4","fonction5"];
$phrase_presentation="<p>L’équipe pégagogique du Département comprend le personnel permanant dont les membres
sont listés à l’aide du tableau ci-après. Elle comprend, en plus, un important personnel non
permanant formé d’enseignants vacataires et d’un personnel administratif d’appui.</p>";

equipe($pdf,$prenoms,$noms,$specialites,$fonctions,$phrase_presentation);

//Partie mot du chef de département
chef($pdf,'Test mot du chef');

//Partie présentation des formations
$formations=["la formation 1","la formation 2","la formation 3","la formation 4","la formation 5"];
$phrase_presentation="Dans la suite de ce livret sont présentées les formations suivantes :";
$annonce_elements="<p> voilà ce <b>que</b> nous allons présenter</p>";

presentation_formation($pdf,$formations,$annonce_elements);

//Partie Extraits du réglement intérieur de l'ESP
reglement($pdf,'Test réglement');

//Partie Présentation de la formation

$semestre=[1,1,1,1,2,2,2];
$ue=["ue1","ue1","ue2","ue2","ue3","ue3","ue4"];
$nom=["module1","module2","module3","module4","module5","module6","module7"];
$code=[1111,1112,1113,1114,1121,1122,1123];
$formation="DUTINFO";
$coeff=[1,3,4,1,2,2,3];
$cm=[1,2,4,3,1,2,4];
$td=[1,2,4,3,1,2,4];
$tp=[1,2,4,3,1,2,4];
$tpe=[1,2,4,3,1,2,4];
$obj=[["reussir cela","connaitre cela"],["reussir cela","connaitre cela"],["reussir cela","connaitre cela"],["reussir cela","connaitre cela"],["reussir cela","connaitre cela"],["reussir cela","connaitre cela"],["reussir cela","connaitre cela"]];
$prerequis=[["module11"],["module12"],["module13"],["module14"],["module15"],["module16"],["module17"]];
$contenu=[["introduction à la méthode11","étude des systèmes multi-variés"],["introduction à la méthode12","étude des systèmes multi-variés"],["introduction à la méthode13","étude des systèmes multi-variés"],["introduction à la méthode14","étude des systèmes multi-variés"],["introduction à la méthode15","étude des systèmes multi-variés"],["introduction à la méthode16","étude des systèmes multi-variés"],["introduction à la méthode17","étude des systèmes multi-variés"]];
$eval=[[15,85,60,40],[15,85,60,40],[15,85,60,40],[15,85,60,40],[15,85,60,40],[15,85,60,40],[15,85,60,40]];
$credits=[15,15,15,15,20,20,10];
$reglement="<p><b>règle 1:</b> blabla bla</p><p><b>règle 2:</b> blabla bla</p><p><b>règle 3:</b> blabla bla</p>";
$phrase_presentation="Voila c'est la formation";
$Informations_utiles="contacter M.jdhu";


formation($pdf,$semestre,$ue,$nom,$code,$formation,$coeff,$cm,$td,$tp,$tpe,$obj,$prerequis,$contenu,$eval,$credits,$reglement,$phrase_presentation,$Informations_utiles);

//page de couverture 

page_couverture($pdf,"(+221) 33 825 75 28)",'GENIE INFORMATIQUE');

//parce que la table des matières est au début du document
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);
$pdf->Set_Header(false,'');
// add a new page for TOC
$pdf->addTOCPage();

// write the TOC title
$pdf->SetTextColor(94,181,77);
$pdf->SetFont('dejavusansextralight', 'B', 16);
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
//$pdf->addTOC(2, 'courier', '', 'Table des matières', 'B', array(94, 181, 77));
$pdf->addHTMLTOC(2, 'Tables des matières', $bookmark_templates, true, 'B', array(128,0,0));


// end of TOC page
$pdf->endTOCPage();

//sigle et abréviations
//équipe pédagogique
//mot du chef de département
//réglement intérieur
//présentation de la formation
//information utile

$pdf->Output('example.pdf', 'I');
