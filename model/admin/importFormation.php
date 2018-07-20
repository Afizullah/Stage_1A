<?php
require_once(PATH_MODEL . "admin/addFormation.php");
function hasFormations($projectId) {
    if (DB::getLine("formation", "formation_id", [["projet_id", $projectId]])) {
        return true;
    }
    return false;
}

function getFormatedFieldsToRegisted($dataFields, $tabSelectedAttrib) {
    $dataToRegistre = array();


    for ($i = 0; $i < count($tabSelectedAttrib); $i++) {

        if (array_key_exists($tabSelectedAttrib[$i], $dataFields)) {
            $dataToRegistre[] = [$tabSelectedAttrib[$i], $dataFields[$tabSelectedAttrib[$i]]];
        } else {
            die("L'attribut " . $tabSelectedAttrib[$i] . " est introuvable");
        }
    }
    return $dataToRegistre;
}

function registreFields($tableName, $dataFields) {
    return DB::registre($tableName, $dataFields);
}

class CopyProject extends Formation
{
    private $errors = null;

    function __construct($currentProjectId, $idProjectToImport, $selectedFormations) {
        if ($formations = Formation::getFormations($idProjectToImport)) {
            foreach ($formations as $formationKey => $formationFields) {
                if (in_array($formationFields["formation_nom"], $selectedFormations)) {
                    $resp_id = Formation::deleteFormation($currentProjectId, $formationFields["formation_nom"]);
                    $dataFormated = getFormatedFieldsToRegisted($formationFields, ["formation_code", "formation_nom_complet", "formation_nom", "formation_semestre", "formation_organisation", "formation_evaluation", "formation_autres_infos"]);
                    $dataFormated[] = ["projet_id", intval($currentProjectId)];
                    $dataFormated[] = ["user_id", $resp_id];
                    if ($newFormationId = registreFields("formation", $dataFormated)) {
                        $formationId = intval($formationFields["formation_id"]);
                        if ($classes = Formation::getClasses($formationId)) {
                            foreach ($classes as $classeKey => $classeFields) {
                                $dataClasseFormated = getFormatedFieldsToRegisted($classeFields, ["classe_nom"]);
                                $dataClasseFormated[] = ["formation_id", $newFormationId];
                                if ($newClasseId = registreFields("classe", $dataClasseFormated)) {
                                    $fromClasseId = intval($classeFields["classe_id"]);
                                    if ($ues = Formation::getUes($fromClasseId)) {
                                        foreach ($ues as $ueKey => $ueFields) {
                                            $dataUeFormated = getFormatedFieldsToRegisted($ueFields, ["ue_code", "ue_nom", "ue_semestr"]);
                                            $dataUeFormated[] = ["classe_id", $newClasseId];
                                            if ($newUeId = registreFields("ue", $dataUeFormated)) {
                                                $fromUeId = intval($ueFields["ue_id"]);
                                                if ($ecs = Formation::getEcs($fromUeId)) {
                                                    foreach ($ecs as $ecKey => $ecFields) {
                                                        $ecTabAttrubToImport = ["ec_code", "ec_nom", "ec_competence", "ec_prerequis", "ec_contenu", "ec_coef", "ec_nbre_heure_cm", "ec_nbre_heure_td", "ec_nbre_heure_tp", "ec_nbre_heure_tpe"];
                                                        $dataEcFormated = getFormatedFieldsToRegisted($ecFields, $ecTabAttrubToImport);
                                                        $dataEcFormated[] = ["ue_id", $newUeId];
                                                        if (!$newEcId = registreFields("ec", $dataEcFormated)) {
                                                            $this->errors[] = "Échec de l'importation des informations de l'EC " . $ecFields["ec_code"];
                                                        }
                                                    }
                                                }
                                            } else {
                                                $this->errors[] = "Échec de l'importation des information de l'UE " . $ueFields["ue_code"];
                                            }
                                        }
                                    }
                                } else {
                                    $this->errors[] = "Échec de l'importation des informations de " . $classeFields["classe_nom"];
                                }
                            }
                        }
                    } else {
                        $this->errors[] = "Échec de l'importation de la formation " . $formationFields["formation_nom"];
                    }
                }
            }
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}

?>
