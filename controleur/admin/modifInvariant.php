<?php
    $_listeInvariant = Invariant::getList();
    $_formations = $PROJET->getFormationsNames();
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
    }else if(isset($_POST["importInvariantForm"])){
        $i=0;
        while(isset($_POST["invariant_".$i]) || $i<20){
            if(isset($_POST["invariant_".$i])){
                if($curentIdInv = intval($_POST["invariant_".$i])){
                    $invariantFormToImport[] = $curentIdInv;
                }
            }
            $i++;
        }
        if(isset($invariantFormToImport)){
            if($errorsImportInvariant = Invariant::importProjInvariant($PROJET->getId(),$invariantFormToImport)){
                for ($i=0; $i < count($errorsImportInvariant); $i++) {
                    $errors[]=$errorsImportInvariant[$i];
                }
            }else{
                $terminaison = (count($invariantFormToImport)>1)?"s":"";
                $success = "Invariant".$terminaison." importé".$terminaison." avec succès";
            }
        }else{
            $errors[]="Aucun invariant séléctionné";
        }
    }
?>
