<?php
require_once(PATH_CONTROLEUR.'admin/genereLivret/header.php');

if (isset($_POST["selectFormations"],$_POST["formationsSelected"])) {
    $formationsSelected = $_POST["formationsSelected"];
    //page de garde
    page_de_garde($pdf, "2017-2018", 'GENIE INFORMATIQUE',"(+221) 33 825 75 28)", "secretariat-dgi@esp.sn");

    // set font
    $pdf->SetFont('times', 'B', 20);
    //$pdf->SetFont('times', 'BI', 14);
    if($formationsSelected){
        $projetId = $PROJET->getId();
        $invariants = Invariant::getInvariant($projetId);
        for ($i=0; $i < count($invariants); $i++) {
            $invariantNom = $invariants[$i]["invariant_nom"];
            $invariantContenu = $invariants[$i]["invariant_contenu"];
            printInvariant($pdf,$invariantNom,$invariantContenu);
        }
        for ($i=0; $i < count($formationsSelected) ; $i++) {
            $formationId = $formationsSelected[$i];
        }
    }else{
        header("Location:index.php?page=genererLivret");
        die();
    }

}else{
    header("Location:index.php?page=genererLivret");
    die();
}

 ?>
