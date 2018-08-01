<?php 
require_once(PATH_MODEL.'admin/projet.class.php');
class importForm extends DB{
    public static function getFormations($user_id,$projet_id){
        return DB::query("SELECT formation_nom FROM formation WHERE user_id=$user_id AND projet_id=$projet_id AND formation_etat='non_publie'");
    }
    public static function getNomFromCode($code_parcours){
    	return DB::query("SELECT formation_nom FROM formation WHERE formation_code='".$code_parcours."'");
    }
    public static function getNomNonPublie($projet_id){
    	return DB::query("SELECT formation_nom FROM formation WHERE projet_id=$projet_id AND formation_etat='non_publie'");
    }
}
?>