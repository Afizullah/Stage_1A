<?php

class aff_suggestion extends DB{
    public function getSuggestion($user_id){
        return DB::query("SELECT  projet_nom,suggestion_id,suggestion_etat,suggestion_valeur,suggestion_cible,suggestion_cible_id FROM suggestions NATURAL JOIN suggestions_projet_utilisateur NATURAL JOIN projet WHERE $user_id=user_id");
    }
    public function getCibleNom($ue_ec,$cible_id){
    	if ($ue_ec){
    		return DB::query("SELECT ue_nom FROM ue WHERE $cible_id=ue_id");
    	}
    	else {
    		return DB::query("SELECT ec_nom FROM ec WHERE $cible_id=ec_id");
    	}
    }
    public function test_delete($user_id,$sugg_id){
    	return DB::query("SELECT * FROM suggestions_projet_utilisateur WHERE $user_id=user_id AND $sugg_id=suggestion_id");
    }
    public function delete_suggestion($sugg_id){
    	DB::execute("DELETE FROM suggestions_projet_utilisateur WHERE suggestion_id=$sugg_id");
    	DB::execute("DELETE FROM suggestions WHERE suggestion_id=$sugg_id");
    }
}	
?>