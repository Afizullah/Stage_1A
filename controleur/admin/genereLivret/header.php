<?php
    require_once(PATH_CONTROLEUR.'libs/TCPDF-master/tcpdf.php');

    require_once(PATH_CONTROLEUR.'admin/genereLivret/fonctions_utiles.php');
    require_once(PATH_CONTROLEUR.'admin/genereLivret/header_footer.php');

    require_once(PATH_CONTROLEUR.'admin/genereLivret/page_de_garde.php');
    require_once(PATH_CONTROLEUR.'admin/genereLivret/invariants.php');
    require_once(PATH_CONTROLEUR.'admin/genereLivret/reglementFormation.php');
    require_once(PATH_CONTROLEUR.'admin/genereLivret/autresInformationsUtiles.php');
    require_once(PATH_CONTROLEUR.'admin/genereLivret/tableau_livret.php');

    require_once(PATH_CONTROLEUR.'admin/genereLivret/formation.php');
    require_once(PATH_CONTROLEUR.'admin/genereLivret/page_couverture.php');
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

 ?>
