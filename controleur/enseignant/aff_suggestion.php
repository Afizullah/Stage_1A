<?php
require_once(PATH_CONTROLEUR."commun.user.php");
$user_id=CurrentUser::getId();
if(isset($_REQUEST["id"])){
    $sugg_id = secure($_REQUEST["id"]);
    if (count(aff_suggestion::test_delete($user_id,$sugg_id))!=0){
    	aff_suggestion::delete_suggestion($sugg_id);
    	$html='<div style="color:green;"> Suggestion supprimée </div>';
    }
    else {
    	$html='<div style="color:red;"> Vous n êtes pas autorisé à supprimer cette suggestion</div>;';
    }
}

$tab=aff_suggestion::getSuggestion($user_id);
for ($i=0;$i<count($tab);$i++){
		$resu[$i]['projet_nom']=$tab[$i]['projet_nom'];
		$resu[$i]['suggestion_valeur']=$tab[$i]['suggestion_valeur'];
		$resu[$i]['suggestion_etat']=$tab[$i]['suggestion_etat'];
		$resu[$i]['type']=$tab[$i]['suggestion_cible'];
		$resu[$i]['suggestion_id']=$tab[$i]['suggestion_id'];
	if (strcmp($tab[$i]['suggestion_cible'],'ue_nom')==0){
		$resu[$i]['suggestion_cible']=aff_suggestion::getCibleNom(true,$tab[$i]['suggestion_cible_id'])[0]['ue_nom'];
		}
	if ($tab[$i]['suggestion_cible_id']!=0){
		$resu[$i]['suggestion_cible']=aff_suggestion::getCibleNom(false,$tab[$i]['suggestion_cible_id'])[0]['ec_nom'];
	}
}
