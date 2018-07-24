<?php
require_once(PATH_MODEL."admin/modifInvariant.php");
require_once(PATH_MODEL."admin/addFormation.php");

function recuperation($formation){
	$tab=DB::getData("ec NATURAL JOIN ue NATURAL JOIN classe NATURAL JOIN formation","*");
	for($i=0;$i<count($tab) && strcmp($tab[$i]["formation_nom"],$formation)==0;$i++){
		$semestre[$i]=$tab[$i]["ue_semestr"];
		$ue[$i]=$tab[$i]["ue_nom"];
		$nom[$i]=$tab[$i]["ec_nom"];
		$code[$i]=$tab[$i]["ue_code"];
		$coeff[$i]=$tab[$i]["ec_coef"];
		$cm[$i]=$tab[$i]["ec_nbre_heure_cm"];
		$td[$i]=$tab[$i]["ec_nbre_heure_td"];
		$tp[$i]=$tab[$i]["ec_nbre_heure_tp"];
		$tpe[$i]=$tab[$i]["ec_nbre_heure_tpe"];
		$credits[$i]=$tab[$i]["ue_nbre_cred"];
		$obj[$i]=$tab[$i]["ec_competence"];
		$prerequis[$i]=$tab[$i]["ec_prerequis"];
		$contenu[$i]=$tab[$i]["ec_contenu"];
		$eval[$i]=[33,66,40,60];
	}
	return [$semestre,$ue,$nom,$code,$formation,$coeff,$cm,$td,$tp,$tpe,$obj,$prerequis,$contenu,$eval,$credits];
}

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
	public static function getDimunitifSelectedFormation($idsSelected){
		$dimunitifs = array();
		for ($i=0; $i <count($idsSelected) ; $i++) { 
			$thisFormationId = intval($idsSelected[$i]);
			if($thisLine = DB::getLine("formation","formation_nom",[["formation_id",$thisFormationId]])){
				$currentDimunitif = explode("-",trim($thisLine["formation_nom"]));
				$currentDimunitif = explode(" ",trim($currentDimunitif[0]));
				$currentDimunitif = strtoupper($currentDimunitif[0]);
				if(!in_array($currentDimunitif,$dimunitifs)){
					$dimunitifs[] = $currentDimunitif;
				}

			}
		}
		if($dimunitifs){
			return implode("-",$dimunitifs);
		}
		return null;

	}
}
?>
