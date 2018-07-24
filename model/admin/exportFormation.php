<?php

class exportForm extends DB
{
    public static function getFormation($user_id) {
        return DB::query("SELECT * FROM ec NATURAL JOIN ue NATURAL JOIN classe NATURAL JOIN formation WHERE user_id=$user_id");
    }

    public static function getFormation_form($formation_id) {
        return DB::query("SELECT * FROM ec NATURAL JOIN ue NATURAL JOIN classe NATURAL JOIN formation WHERE formation_id=$formation_id");
    }
}

?>