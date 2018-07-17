<?php 
class importForm extends DB{
    public function getFormations($user_id){
        return DB::query("SELECT formation_nom FROM formation WHERE user_id=$user_id");
    }
}
?>