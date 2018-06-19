<?php
    require_once(PATH_CONTROLEUR."commun.func.php");
    class Login extends DB{
        public static function verify($email,$password){
            $today=today();
            return DB::query("SELECT utilisateurs.user_id,utilisateurs.user_nom,utilisateurs.user_prenom,utilisateurs.user_mail,
                              compte.compte_typeCompte,compte.compte_id FROM utilisateurs
                              INNER JOIN compte ON compte.user_id=utilisateurs.user_id
                              WHERE utilisateurs.user_mail='{$email}'  AND utilisateurs.user_mdpasse='{$password}' AND compte.compte_dateExpiration>='{$today}'
            ");
        }

    }
