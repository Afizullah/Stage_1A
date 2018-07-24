<?php
require_once(PATH_CONTROLEUR . "commun.user.php");
/*if (isset($_POST["formationsSelected"])) {
var_dump($_POST["formationsSelected"]);
var_dump(exportForm::getFormation_form($_POST["formationsSelected"]));
die();
}
*/
function getTab($formation_id)
{
    return exportForm::getFormation_form($formation_id);
}

function getleafColsRequired()
{
    return ["Code_Parcours", "CodeUE", "CodeEC", "Semestre",/* ??? "TypeCompetence",*/
        "Classe", "Matiere", "Compétences", "Preréquis", "Contenu", "Nb Heures CM", "Nb Heures TD", "Nb Heures TP", "Nb Heures TPE", "Coefficient"];
}

function getchamps()
{
    return ["formation_code", "ue_code", "ec_code", "ue_semestr", "classe_nom", "ec_nom", "ec_competence", "ec_prerequis", "ec_contenu", "ec_nbre_heure_cm", "ec_nbre_heure_td", "ec_nbre_heure_tp", "ec_nbre_heure_tpe", "ec_coef"];
}
?>