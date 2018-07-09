<?php
require_once(PATH_MODEL."admin/modifInvariant.php");
require_once(PATH_MODEL."admin/addFormation.php");

class Livret extends DB{
    public function getAllInfosModules($formationId){
        return DB::query("SELECT ue.ue_semestr,ue.ue_nom,ec.ec_nom,ec.ec_code,ec.ec_coef,ec.ec_prerequis,ec.ec_contenu,
                                 ec.ec_nbre_heure_cm,ec.ec_nbre_heure_td,ec.ec_nbre_heure_tp,ec.ec_nbre_heure_tpe,
                                 ec.ec_competence,formation.formation_evaluation    FROM ec
            INNER JOIN ue ON ec.ue_id=ue.ue_id
            INNER JOIN classe ON ue.classe_id=classe.classe_id
            INNER JOIN formation ON classe.formation_id=formation.formation_id
            WHERE classe.formation_id=".$formationId." ORDER BY ue.ue_semestr ASC");
    }
}
?>
