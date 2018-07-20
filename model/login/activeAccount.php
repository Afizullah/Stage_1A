<?php
require_once(DB_OPT_FILE);
require_once(PATH_MODEL . "admin/addUser.php");

class ActiveAccount extends DB
{

    public static function activeNewAccount($typeDeCompte, $prenom, $nom, $email, $mot_de_passe, $dateExpiration) {
        if ($userId = DB::registre("utilisateurs", [["user_nom", $nom], ["user_prenom", $prenom], ["user_mail", $email], ["user_mdpasse", $mot_de_passe]])) {
            return DB::registre("compte", [["user_id", $userId], ["compte_dateExpiration", $dateExpiration], ["compte_typeCompte", $typeDeCompte]]);
        }
        return false;
    }

}

?>
