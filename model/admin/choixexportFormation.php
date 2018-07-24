<?php
/**
 * Created by PhpStorm.
 * User: Afiz
 * Date: 23/07/2018
 * Time: 16:41
 */

class choixexportFormation extends DB
{
    public static function getFormation($projetID){
        return DB::query("SELECT * FROM formation WHERE projet_id=$projetID");
    }
}