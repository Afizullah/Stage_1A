<?php

    class ShowUsers extends DB {
        public static function getAdmin() {
            return DB::query("SELECT utilisateurs.user_id,utilisateurs.user_nom,utilisateurs.user_prenom,utilisateurs.user_mail,
                compte.compte_typeCompte,compte.compte_id FROM utilisateurs INNER JOIN compte ON compte.user_id = utilisateurs.user_id
                WHERE compte.compte_typeCompte = 'administrateur'");
            // $dataAccount = DB::getData("compte","compte_typeCompte",[["compte_id",$compte_id]]);
        }
        public static function getEnseignant() {
            return DB::query("SELECT utilisateurs.user_id,utilisateurs.user_nom,utilisateurs.user_prenom,utilisateurs.user_mail,
                compte.compte_typeCompte,compte.compte_id FROM utilisateurs INNER JOIN compte ON compte.user_id = utilisateurs.user_id
                WHERE compte.compte_typeCompte = 'enseignant'");
            // $dataAccount = DB::getData("compte","compte_typeCompte",[["compte_id",$compte_id]]);
        }
        public static function getRespons() {
            return DB::query("SELECT utilisateurs.user_id,utilisateurs.user_nom,utilisateurs.user_prenom,utilisateurs.user_mail,
                compte.compte_typeCompte,compte.compte_id FROM utilisateurs INNER JOIN compte ON compte.user_id = utilisateurs.user_id
                WHERE compte.compte_typeCompte = 'responsable_pedagogique'");
            // $dataAccount = DB::getData("compte","compte_typeCompte",[["compte_id",$compte_id]]);
        }
        public static function registerGroup($userId,$groupId) {
            return DB::registre("groupe_utilisateurs",[["user_id",$userId],["groupe_id",$groupId]]);
        }

        public static function deleteGroup($userId,$groupId) {
            return DB::execute("DELETE FROM groupe_utilisateurs WHERE groupe_id = ".$groupId." AND user_id = ".$userId);
        }
    }

?>