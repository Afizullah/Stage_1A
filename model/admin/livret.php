<?php
require_once(PATH_MODEL."admin/modifInvariant.php");

function recuperation($formation{
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
    
}
?>
