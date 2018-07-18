<?php 
require_once(PATH_MODEL.'admin/projet.class.php');
class importForm extends DB{
    public function getFormations($user_id,$projet_id){
        return DB::query("SELECT formation_nom FROM formation WHERE user_id=$user_id AND projet_id=$projet_id");
    }
}
?>