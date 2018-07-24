<?php
function activeAccount()
{
    global $errors;
    if (!empty($_POST['password']) || !empty($_POST['cnfpassword'])) {
        if ($_POST['password'] == $_POST['cnfpassword']) {
            //    die("ok");
            if ($dataUserTable = USER::verifToken(secure($_POST['token']))) {
                if ($dataUserTable['user_date_exp_temp'] > NOW()) {
                    if (ActiveAccount::activeNewAccount(
                        $dataUserTable["user_type_de_compte"],
                        $dataUserTable["user_prenom"],
                        $dataUserTable["user_nom"],
                        $dataUserTable["user_mail"],
                        _hash($_POST['password']),
                        $dataUserTable["user_date_expiration"])
                    ) {
                        header("Location:index.php?page=login");
                    } else {
                        $errors[] = "Échec de l'enregistrement du compte";
                    }

                } else {
                    $errors[] = "La date d'expiration est dépassée";
                }
            } else {
                $errors[] = "Vérifiez le lien";
            }
        } else {
            $errors[] = "Les deux mots de passe ne sont pas identiques";
        }
    } else {
        $errors[] = "Vérifiez les champs à remplir";
    }
}

if (isset($_POST["activeCompte"], $_POST["password"], $_POST["cnfpassword"])) {
    activeAccount();
}

// Token existant dans la base de données date d'exp
// 2 Mot de passe correct
// Envoyer le résultat de la requête avec getLine et envoyer le résultat et le token en paramètre
?>
