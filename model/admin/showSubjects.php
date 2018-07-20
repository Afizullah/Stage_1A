<?php
require_once(PATH_MODEL . "admin/assync.loadSuggest.php");

Class Subjects extends DB
{
    function getSubjectsInGroup($groupId) {
        return DB::query('SELECT ec_code, ec_id, ec_nom, ec_competence, ec_prerequis FROM ec WHERE groupe_id =' . $groupId);
    }

    function getSubjectsWithoutGroup($idProjet) {
        return DB::query("SELECT ec_nom,ec_id FROM ec
                            INNER JOIN ue ON ec.ue_id=ue.ue_id
                            INNER JOIN classe ON classe.classe_id=ue.classe_id
                            INNER JOIN formation ON formation.formation_id=classe.formation_id
                            WHERE formation.projet_id = " . $idProjet . " AND groupe_id IS NULL ");
    }

    function recordGroup($groupId, $ecId) {
        return DB::update("ec", [["groupe_id", $groupId]], [["ec_id", $ecId]]);
    }

    function getSuggestion() {
        return DB::query('SELECT * FROM suggestions');
    }

    function recordNom($ecId, $ecNom) {
        return DB::update("ec", [["ec_nom", $ecNom]], [["ec_id", $ecId]]);
    }
}

?>