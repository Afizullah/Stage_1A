<?php
    //Control sur le droit d'accès à cette & sur l'accès à travers un lien direct
    if(defined("SESS_ADMIN_CONTROLER")){
        if(file_exists(SESS_ADMIN_CONTROLER)){
            require_once(SESS_ADMIN_CONTROLER);
        }else{
            header("Location:../");
            die("<center><b>ERROR</b>::Accès non autorisé</center>");
        }
    }else{
        header("Location:../");
        die("<center><b>ERROR</b>::Accès non autorisé</center>");
    }
?>
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
$pdf->toc = true;
$pdf->addHTMLTOC(2, 'Table des matières', $bookmark_templates, true, 'B', array(128,0,0));

// end of TOC page
$pdf->endTOCPage();

//ob_end_clean();
//Création du fichier et de sa vignette
$filelocation = "/var/www/html/livret/model/livret-pdf/";
$filename='Formation' . $pdf->getDocName();
$pdf->Output($filelocation.$filename.".pdf", 'F');

$im = new imagick(PATH_MODEL."livret-pdf/".$filename.".pdf[0]");
$im->writeImage(PATH_MODEL."livret-pdf/".$filename.'.png');
?>


<style>
    img:hover {
    border: 3px;
    border-style: solid;    
    border-color: #878787;
}


</style>

<h3> Livret généré </h3>
</br>
<p id="resu"></p>
</br>
<p>
    Voici le livret que vous avez généré, vous pouvez maintenant choisir de le publier:
</p>

<table style="width:50%; text-align: center; ">
    <tr>
        <td><a href=<?php echo PATH_MODEL."livret-pdf/".$filename.".pdf"?> onclick="window.open(this.href); return false;" >
                <div class="lien">
                    <img src=<?php echo PATH_MODEL."livret-pdf/".$filename.".png"?> width="160" height="240" alt="livret"/>
                </div>
            </a>
        </td>
        <td>
            <form method="post" id="f1">
                <input type="text" name="filename" value="<?php echo $filename?>" style="display:none;" >
                <input type="button" onclick="testfile('f1')" class="btn btn-info" value="Publier le livret"/>
            </form>
        </td>
    </tr>
    <tr>
        <td><?php echo $filename.'.pdf';?></td>
    </tr>

<script type="text/javascript">
    function testfile(val){
        //document.getElementById("contentExcelFileAnalyse").innerHTML='<center><div class="loader"></div></center>';
        var fd = new FormData(document.getElementById(val));
       fd.append("label", val);
       $.ajax({
         url: "index.php?page=assync_livret",
         type: "POST",
         data: fd,
         //mimeTypes:"multipart/form-data",
         processData: false,  // tell jQuery not to process the data
         contentType: false   // tell jQuery not to set contentType
       }).done(function( data ) {
            document.getElementById("resu").innerHTML=data;
       });
       return false;
    }
</script>