<?php

    class Group extends DB {
        public function createGroup($groupe_nom,$idProject) {
            return DB::registre("groupe",[["groupe_specialite",$groupe_nom],["projet_id",$idProject]]);
        }
        public function addUser($groupeId,$userId){
            return parent::registre("groupe_utilisateurs",[["groupe_id",intval($groupeId)],["user_id",$userId]]);
        }
    }

?>
