<?php
class suggestion extends DB{
    public function getSuggestion(){
        return DB::query("SELECT * FROM suggestions ORDER BY suggestion_id ASC");	
    }
	function registre_sugg($suggestion_id,$suggestion_cible,$suggestion_cible_id,$suggestion_valeur,$suggestion_etat){
		return parent::registre("suggestions",[["suggestion_id",$suggestion_id],["suggestion_cible",$suggestion_cible],["suggestion_cible_id",$suggestion_cible_id],["suggestion_valeur",$suggestion_valeur],["suggestion_etat",$suggestion_etat]]);
	}
	function registre_sugg_user($suggestion_id,$user_id,$projet_id){
		return parent::registre("suggestions_projet_utilisateur",[["suggestion_id",$suggestion_id],["user_id",$user_id],["projet_id",$projet_id]]);
	}
	function non_suggestion($suggestion_valeur,$suggestion_cible_id,$suggestion_cible){
		return DB::query("SELECT * FROM ec WHERE ec_id=".'"'.$suggestion_cible_id.'"'." AND $suggestion_cible=".'"'.$suggestion_valeur.'"');
	}
	function non_suggestion_ue($suggestion_valeur,$suggestion_cible_id){
		return DB::query("SELECT * FROM ec NATURAL JOIN ue WHERE ue_id=".'"'.$suggestion_cible_id.'"'." AND ue_nom=".'"'.$suggestion_valeur.'"');
	}
}
?>