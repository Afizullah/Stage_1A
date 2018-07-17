<?php
class Groupe extends DB{
    public static function getGroupes($id_user){
        return DB::query("SELECT * FROM groupe NATURAL JOIN groupe_utilisateurs NATURAL JOIN projet WHERE $id_user=user_id");
    }
}
?>