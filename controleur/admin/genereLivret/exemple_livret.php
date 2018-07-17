<?php
// Include the main TCPDF library (search for installation path).
require_once PATH_CONTROLEUR.'admin/header_footer.php';
require_once 'page_de_garde.php';
require_once 'sigle.php';
require_once 'presentation_equipe.php';
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
page_de_garde($pdf, "2017-2018", 'GENIE INFORMATIQUE',"(+221) 33 825 75 28)", "secretariat-dgi@esp.sn");

// set font
$pdf->SetFont('times', 'B', 20);
//$pdf->SetFont('times', 'BI', 14);

//Partie sigle et abréviations
sigle($pdf,'Test sigle');

//Partie équipe pédagogique
$prenoms=["prenom1","prenom2","prenom3","prenom4","prenom5"];
$noms=["nom1","nom2","nom3","nom4","nom5"];
$specialites=["specialite1","specialite2","specialite3","specialite4","specialite5"];
$fonctions=["fonction1","fonction2","fonction3","fonction4","fonction5"];
$phrase_presentation="<p>L’équipe pégagogique du département comprend le personnel permanant dont les membres
sont listés à l’aide du tableau ci-après. Elle comprend, en plus, un important personnel non
permanant formé d’enseignants vacataires et d’un personnel administratif d’appui.</p>";

equipe($pdf,$prenoms,$noms,$specialites,$fonctions,$phrase_presentation);

//Partie mot du chef de département
chef($pdf,'Test mot du chef');

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


$pdf->Output('test.pdf', 'I');
