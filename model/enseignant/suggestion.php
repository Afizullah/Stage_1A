<?php

class EC_suggestion extends DB
{
    public function getEC($groupe_id) {
        return DB::query("SELECT * FROM ec  NATURAL JOIN ue NATURAL JOIN classe NATURAL JOIN formation WHERE $groupe_id=groupe_id AND formation_etat='non_publie'");
    }
}

?>