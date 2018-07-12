<?php
class EC_suggestion extends DB{
    public function getEC($groupe_id){
        return DB::query("SELECT * FROM ec WHERE $groupe_id=groupe_id");
    }
}
?>