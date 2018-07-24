<?php

class ShowUsers extends DB
{
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

    public static function registerGroup($userId, $groupId) {
        return DB::registre("groupe_utilisateurs", [["user_id", $userId], ["groupe_id", $groupId]]);
    }

    public static function deleteGroup($groupId) {
        return DB::execute("DELETE FROM groupe_utilisateurs WHERE groupe_id = " . $groupId);
    }

    public static function getFormationRP($user_id){
        return DB::query("SELECT formation_nom,formation_id FROM formation WHERE user_id=$user_id");
    }

    public static function getFormations($projet_id){
        return DB::query("SELECT formation_nom,formation_id FROM formation WHERE projet_id=$projet_id");
    }
    
    public static function est_respo($user_id,$projet_id){
        return DB::query("SELECT formation_id FROM formation WHERE user_id=$user_id AND projet_id=$projet_id");
    }

    public static function current_respo($formation_id){
        return DB::query("SELECT user_id FROM formation WHERE formation_id=$formation_id");
    }

    public static function delete_respo($formation_id,$user_id){
        DB::update("formation",[["user_id",NULL]],[["formation_id",$formation_id]]);
        DB::execute("DELETE FROM compte WHERE user_id=$user_id AND compte_typeCompte='responsable_pedagogique'");
    }

    public static function create_respo($formation_id,$user_id){
        DB::update("formation",[["user_id",$user_id]],[["formation_id",$formation_id]]);
        $tab=DB::query("SELECT compte_dateExpiration FROM compte WHERE user_id=$user_id AND compte_typeCompte='enseignant'");
        $date_exp=$tab[0]['compte_dateExpiration'];
        DB::registre("compte",[["user_id",$user_id],["compte_dateExpiration",$date_exp],["compte_typeCompte","responsable_pedagogique"]]);
    }
}

?>