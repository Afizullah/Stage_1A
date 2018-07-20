<?php

Class Invariant extends DB
{
    public static function getInvariant($projetId)
    {
        return DB::query("SELECT projet_invariant.invariant_id, invariant.invariant_id, invariant.invariant_nom, invariant.invariant_contenu FROM invariant
                              INNER JOIN projet_invariant ON invariant.invariant_id=projet_invariant.invariant_id
                              WHERE projet_invariant.projet_id=" . $projetId . "
                              ");
    }

    public static function recordModifFormation($formationId, $formationOrganisation, $formationEvaluation, $formationAutresInfo, $formationNomComplet)
    {
        return DB::update("formation", [["formation_organisation", $formationOrganisation], ["formation_evaluation", $formationEvaluation], ["formation_autres_infos", $formationAutresInfo], ["formation_nom_complet", $formationNomComplet]], [["formation_id", $formationId]]);
    }

    public static function getList()
    {
        return DB::query("SELECT DISTINCT invariant_nom FROM invariant");
    }

    public static function getProjectWithInvariant($invariantName, $projetId)
    {
        return DB::getData("projet_invariant NATURAL JOIN invariant NATURAL JOIN projet", "projet_id,invariant_id,invariant_contenu,projet_nom", [["invariant_nom", $invariantName], ["projet_id", intval($projetId)]], ["=", "!="]);
    }

    public static function importProjInvariant($currentProjectId, $idsInvariantsToImport)
    {
        $errors = array();
        for ($i = 0; $i < count($idsInvariantsToImport); $i++) {
            if ($infosFromInvariant = self::getInvariantInfos($idsInvariantsToImport[$i])) {
                if ($currentInvInfos = self::invariantExiste($currentProjectId, $infosFromInvariant["invariant_nom"])) {
                    if (!self::recordModif($currentInvInfos["invariant_id"], $infosFromInvariant["invariant_contenu"])) {
                        $errors[] = "Échec modification";
                    }
                } else {
                    if ($idNewInvariant = DB::registre("invariant", [["invariant_nom", $infosFromInvariant["invariant_nom"]], ["invariant_contenu", $infosFromInvariant["invariant_contenu"]]])) {
                        DB::registre("projet_invariant", [["projet_id", $currentProjectId], ["invariant_id", $idNewInvariant]]);
                    } else {
                        $errors[] = "Échec de l'importation de l'invariant " . $infosFromInvariant["invariant_nom"];
                    }
                }
            }
        }
        return $errors;
    }

    private static function getInvariantInfos($invariantId)
    {
        return DB::getLine("invariant", "*", [["invariant_id", intval($invariantId)]]);
    }

    private function invariantExiste($currentProjectId, $invariantName)
    {
        return DB::getLine("projet_invariant NATURAL JOIN invariant NATURAL JOIN projet", "invariant_id", [["projet_id", $currentProjectId], ["invariant_nom", $invariantName]]);
    }

    public static function recordModif($invariantId, $invariantContent)
    {
        return DB::update("invariant", [["invariant_contenu", $invariantContent]], [["invariant_id", $invariantId]]);
    }
}

?>
