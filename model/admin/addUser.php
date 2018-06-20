<?php

    Class User extends DB {
        public static function addUserTemp($prenom,$nom,$mail,$accountType,$dateExp){

            $newToken = getNewToken();
            DB::registre("utilisateurs_temporaires",[["user_prenom",$prenom],["user_nom",$nom],["user_mail",$mail],["user_date_expiration",$dateExp],["user_token",$newToken],["user_type_de_compte",$accountType]]);

        }

    }

?>
<!-- 
    Enregistrer dans utilisateurs temporaires en générant un token
    AddUser va prendre en parmètre un token et un mot de passe
    Récupérer les informations qui concerne le token et ensuite enregistrer les informations dans la table utiliateurs

-->