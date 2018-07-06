<?php

    if (isset($_POST['modifInvariant'],$_POST['invariantId'],$_POST['invariantContent'],$_POST["formationId"],$_POST["formationNomComplet"],$_POST["formationOrganisation"],$_POST["formationEvaluation"],$_POST["formationAutresInfos"])) {
        $invariantId = $_POST['invariantId'];
        $invariantContent = $_POST['invariantContent'];
        $formationsIds = $_POST["formationId"];
        $formationsOrganisations = $_POST["formationOrganisation"];
        $formationsEvaluations = $_POST["formationEvaluation"];
        $formationsAutresInfos = $_POST["formationAutresInfos"];
        $formationsNomComplets = $_POST["formationNomComplet"];
        for ($i=0; $i <count($formationsIds) ; $i++) {
            if(!Invariant::recordModifFormation(
                $formationsIds[$i],
                $formationsOrganisations[$i],
                $formationsEvaluations[$i],
                $formationsAutresInfos[$i],$formationsNomComplets[$i])){
                $errors[]="Echec de l'enregistrement des modifications liées à la formation ".$formationsIds[$i];
            }
        }
        for($i=0; $i<count($invariantContent);$i++) {
            if(!Invariant::recordModif($invariantId[$i],$invariantContent[$i])){
                $errors[]="Echec de l'enregistrement des modifications liées à l'invariant ".$invariantId;
            }
        }
        if(!isset($errors)){
            $success = "Enregistrement effectuées avec success";
        }

    }

?>
