<?php

    require_once('../admin/addUser.php');

    function activeAccount() {
        if (!empty($_POST['password']) || !empty($_POST['cnfpassword'])) {
            if ($_POST['password'] != $_POST['cnfpassword']) {
                if ($dataUserTable = USER::verifToken(secure($_POST['token']))) {
                    if ($dataUserTable['user_date_exp_temp']<NOW()){
                        $password = _hash($_POST['password']);
                        if($idUser = USER::addUser($dataUserTable['user_nom'],$dataUserTable['user_prenom'],$dataUserTable['user_mail'],$password)){
                            DB::registre("compte",[["user_id",$idUser],["compte_dateExpiration",$dataUserTable['user_date_expiration']],["compte_typeCompte",$dataUserTable['user_type_de_compte']]]);
                        } else {
                            $errors[] = "L'enregistrement de l'uitilisateur a échoué";
                        }
                    } else {
                        $errors[] = "La date d'expiration est dépassée";
                    }
                } else {
                    $errors[] = "Vérifier le lien";
                }
            } else {
                $errors[] = "Les deux mots de passe ne sont pas identitiques";
            }
        } else {
            $errors[] = "Vérifier les champs à remplir";
        }
    }

    // Token existant dans la base de données date d'exp
    // 2 Mot de passe correct
    // Envoyer le résultat de la requête avec getLine et envoyer le résultat et le token en paramètre 
?>