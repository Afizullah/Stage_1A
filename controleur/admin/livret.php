<?php
require_once(PATH_CONTROLEUR . 'admin/genereLivret/header.php');
if (isset($_POST["selectFormations"], $_POST["formationsSelected"])) {
    $formationsSelected = $_POST["formationsSelected"];
    //page de garde
    page_de_garde($pdf, "2017-2018", 'GÉNIE INFORMATIQUE', "(+221) 33 825 75 28)", "secretariat-dgi@esp.sn");
    $pdf->SetPrintHeader(true);
    $pdf->SetPrintFooter(true);
    $pdf->nb_page++; // table des matières qui vient ensuite mais n'est printé qu'à la fin
    //set font
    $pdf->SetFont('times', 'B', 20);
    $pdf->SetFont('times', 'BI', 14);
    if ($formationsSelected) {
        $projetId = $PROJET->getId();
        $invariants = Invariant::getInvariant($projetId);
        $formationsId = $PROJET->getTabFormationsId();
        for ($i = 0; $i < count($invariants); $i++) {
            $invariantNom = $invariants[$i]["invariant_nom"];
            $invariantContenu = $invariants[$i]["invariant_contenu"];
            //Affichage des invariants
            printInvariant($pdf, $invariantNom, $invariantContenu);
        }
        for ($i = 0; $i < count($formationsSelected); $i++) {
            if ($formationId = intval($formationsSelected[$i])) {
                if (in_array($formationId, $formationsId)) {
                    if ($infosFormation = Formation::getInfosFormation($formationId)) {
                        $formationNomComplet = $infosFormation["formation_nom_complet"];
                        $formationCode = $infosFormation["formation_code"];
                        $pdf->setDocName($pdf->getDocName() . '_' . $formationCode);
                        $formationReglement = $infosFormation["formation_organisation"];
                        $formationInfosUtiles = $infosFormation["formation_autres_infos"];
                        $formation = $infosFormation["formation_nom"];
                        $formationEvaluation = $infosFormation["formation_evaluation"];
                        //Affichage du reglement de la formation
                        printReglementFormation($pdf, $formationNomComplet, $formationCode, $formationReglement);
                        $semestre = array();
                        $ue = array();
                        $nom = array();
                        $code = array();
                        $coef = array();
                        $cm = array();
                        $td = array();
                        $tp = array();
                        $tpe = array();
                        $obj = array();
                        $prerequis = array();
                        $contenu = array();
                        $eval = array();
                        $credits = array();
                        $canPrintSemestres = false;
                        if ($infosModules = Livret::getAllInfosModules($formationId)) {
                            for ($j = 0; $j < count($infosModules); $j++) {
                                $phrase_presentation = "Voila c'est la formation";
                                $semestre[] = $infosModules[$j]["ue_semestr"];
                                $ue[] = $infosModules[$j]["ue_nom"];
                                $nom[] = $infosModules[$j]["ec_nom"];
                                $code[] = $infosModules[$j]["ec_code"];
                                $coef[] = $infosModules[$j]["ec_coef"];
                                $cm[] = $infosModules[$j]["ec_nbre_heure_cm"];
                                $td[] = $infosModules[$j]["ec_nbre_heure_td"];
                                $tp[] = $infosModules[$j]["ec_nbre_heure_tp"];
                                $tpe[] = $infosModules[$j]["ec_nbre_heure_tpe"];
                                $obj[] = $infosModules[$j]["ec_competence"];
                                $prerequis[] = $infosModules[$j]["ec_prerequis"];
                                $contenu[] = $infosModules[$j]["ec_contenu"];
                                $eval[] = $formationEvaluation;
                                $credits[] = 0;
                                $canPrintSemestres = true;
                            }
                            if ($canPrintSemestres) {
                                //Affichage des infos des semestres de la formation
                                formation($pdf, $semestre, $ue, $nom, $code, $formation, $coef, $cm, $td, $tp, $tpe, $obj, $prerequis, $contenu, $eval, $credits, $phrase_presentation);
                            }
                        }
                        //Affichage des informations utiles
                        printOtherInfos($pdf, $formationInfosUtiles);
                    }
                }
            }
        }
        page_couverture($pdf, "(+221) 33 825 75 28)", 'GENIE INFORMATIQUE');
    } else {
        header("Location:index.php?page=genererLivret");
        die();
    }
} else {
    header("Location:index.php?page=genererLivret");
    die();
}
?>
