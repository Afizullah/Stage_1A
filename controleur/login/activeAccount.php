<?php

    require_once('../admin/addUser.php');

    function activeAccount() {
        if (!User::verifDateExpTemp($token)) {
            $errors[] = "La date d'expiration a été atteinte";
            if ($_POST['password'] != $_POST['passwordConf']) {
                $errors[] = "Les deux mots de passe saisies ne sont pas identiques";
            } else {
                
            }
        }
    }

    // Token existant dans la base de données date d'exp
    // 2 Mot de passe correct
    // Envoyer le résultat de la requête avec getLine et envoyer le résultat et le token en paramètre 

?>