<?php

    Class User extends DB {
        public static function addUserTemp($newToken,$prenom,$nom,$mail,$accountType,$dateExpCompte,$dateExpLink){
            return DB::registre("utilisateurs_temporaires",[["user_prenom",$prenom],["user_nom",$nom],["user_mail",$mail],["user_date_exp_temp",$dateExpLink],["user_date_expiration",$dateExpCompte],["user_token",$newToken],["user_type_de_compte",$accountType]]);
        }
        public static function verifToken($token){
            return DB::getLine("utilisateurs_temporaires","*",[["user_token",$token]]);
        }
        public static function verifUserExist($email){
            return DB::getLine("utilisateurs","user_id",[["user_mail",$email]]);
        }
        public static function verifDateExpTemp($token){
            return DB::getLine("utilisateurs_temporaires","user_date_exp_temp",[["user_token",$token]])["user_date_exp_temp"];
        }

        public static function addUser($prenom,$nom,$mail,$password){
            return DB::registre("utilisateurs_temporaires",[["user_prenom",$prenom],["user_nom",$nom],["user_mail",$mail],["user_mdpasse",$password]]);
        }

    }

?>
<!--
    Enregistrer dans utilisateurs temporaires en générant un token
    AddUser va prendre en parmètre un token et un mot de passe
    Récupérer les informations qui concerne le token et ensuite enregistrer les informations dans la table utiliateurs

-->
